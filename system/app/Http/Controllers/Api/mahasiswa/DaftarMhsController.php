<?php

namespace App\Http\Controllers\Api\mahasiswa;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

/*
| class costum crud management
*/
use App\Service\Control\ManagementCrud;
use App\Traits\ManagementRoler;
use App\Traits\ManagementControl;
use Modules\V1\Providers\ManagementServiceProvider;
/*
| end
*/

/*
| USE MODEL
*/
use App\Models\User;
/*
| end
*/

class DaftarMhsController extends Controller
{
    use ManagementRoler;
    use ManagementControl;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['']]);
    }
    public function getById($id = null)
    {
        $prodi = \Modules\V1\Entities\Prodi::whereId($id)->with(["persyaratan_prodi", "biaya_kuliah"])->first();
        return response()->json($prodi);
    }
    public function update_prodi(Request $request)
    {
        try {
            $up_prod = \Modules\V1\Entities\Pendaftaran::whereuserId(auth()->user()->id)->first();
            $up_prod->prodi_id = $request->prodi_id;
            $up_prod->save();
            \Modules\V1\Entities\PilihanProdi::where("pendaftaran_id", $up_prod->id)->delete();
            $pilihan = [
                [
                    "no_pilihan" => "1",
                    "pendaftaran_id" => $up_prod->id,
                    "prodi_id" => $request->prodi_1
                ],
                [
                    "no_pilihan" => "2",
                    "pendaftaran_id" => $up_prod->id,
                    "prodi_id" => $request->prodi_2
                ],
                [
                    "no_pilihan" => "3",
                    "pendaftaran_id" => $up_prod->id,
                    "prodi_id" => $request->prodi_3
                ]
            ];
            foreach ($pilihan as $plp) {
                $pp = new ManagementCrud('PilihanProdi');
                $pathJson =  ManagementServiceProvider::getScemaPath();
                $pp->instance($pathJson);
                $pp->setNameSpaceModel("\Modules\V1\Entities\\");
                $data = new \Illuminate\Http\Request();
                $data->replace($plp);
                $pp->generate_data_insert($data);
            }
            return response()->json($up_prod, 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()], 401);
        }
    }
    public function ortu($request, $ortu_id = null)
    {
        $control_ortu = new ManagementCrud(str_replace('Controller', '', "OrangTuaController"));
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $control_ortu->instance($pathJson);
        $control_ortu->setNameSpaceModel("\Modules\V1\Entities\\");
        if ($ortu_id == null) {
            $calon_ortu =  $control_ortu->generate_data_insert($request);
        } else {
            $calon_ortu =  $control_ortu->generate_data_update($request, $ortu_id);
        }

        return $calon_ortu;
    }
    public function register(Request $request)
    {
        $resources = new ManagementCrud(str_replace('Controller', '', "CalonMahasiswaController"));
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $resources->instance($pathJson);
        $resources->setNameSpaceModel("\Modules\V1\Entities\\");

        $Query = \Modules\V1\Entities\CalonMahasiswa::wherependaftaranId($request->pendaftaran_id)->with("orangtua")->first();
        // $__ortu = \Modules\V1\Entities\OrangTua::where("calon_mahasiswa_id", $Query->id)->first();

        if (empty($Query)) {
            /*
            | MANAGEMENT CONTROL CALON MAHASISWA
            */
            $calon_mhs =  $resources->generate_data_insert($request);
            /*
            | end
            */
            /*
            | MANAGEMENT CONTROL CALON ORANGTUA
            */
            if (!empty($calon_mhs['data']))
                $this->ortu($request->merge(["calon_mahasiswa_id" => $calon_mhs['data']['id']]));
            /*
            | end
            */
            return response()->json($calon_mhs, $calon_mhs["status"] ?? 400);
        } else {
            /*
            | UPDATE MANAGEMENT CONTROL CALON MAHASISWA
            */
            $calon_mhs_update =  $resources->generate_data_update($request, $Query->id);
            $id_ortu = !empty($Query->orangtua) ? $Query->orangtua->id : null;
            $this->ortu($request->merge(["calon_mahasiswa_id" => $Query->id]), $id_ortu);
            /*
            | end
            */
            return response()->json($calon_mhs_update, $calon_mhs_update["status"] ?? 400);
        }
    }
    public function upload_bukti_biaya_pendaftaran(Request $request)
    {
        $resources = new ManagementCrud(str_replace('Controller', '', "BuktiPembayaranController"));
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $resources->instance($pathJson);
        $resources->setNameSpaceModel("\Modules\V1\Entities\\");

        $io = \Modules\V1\Entities\Pendaftaran::whereuserId(auth()->user()->id)->with("bukti_pembayaran")->first();
        if (empty($io->bukti_pembayaran)) {
            /*
            | MANAGEMENT CONTROL CALON MAHASISWA
            */
            $m_control =  $resources->generate_data_insert($request->merge(["pendaftaran_id" => $io->id]));
            /*
            | end
            */
            return response()->json($m_control, $m_control["status"] ?? 400);
        } else {

            /*
            | UPDATE MANAGEMENT CONTROL CALON MAHASISWA
            */
            $m_control =  $resources->generate_data_update($request, $io->bukti_pembayaran->id);
            /*
            | end
            */
            return response()->json($m_control, $m_control["status"] ?? 400);
        }
    }
    public function upload_lampiran(Request $request)
    {
        $resources = new ManagementCrud("LampiranPendaftaran");
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $resources->instance($pathJson);
        $resources->setNameSpaceModel("\Modules\V1\Entities\\");

        $io = \Modules\V1\Entities\Pendaftaran::whereuserId(auth()->user()->id)->with("lampiran_pendaftaran")->first();
        if (empty($io->lampiran_pendaftaran)) {
            /*
            | MANAGEMENT CONTROL CALON MAHASISWA
            */
            $m_control =  $resources->generate_data_insert($request->merge(["pendaftaran_id" => $io->id]));
            /*
            | end
            */
            try {
                if (!empty($m_control['data']['foto_formal'])) {
                    $user = \App\Models\User::find(auth()->user()->id);
                    $user->foto = $m_control['data']['foto_formal'];
                    $user->save();
                }
            } catch (\Throwable $th) {
            }
            return response()->json($m_control, $m_control["status"] ?? 400);
        } else {

            /*
            | UPDATE MANAGEMENT CONTROL CALON MAHASISWA
            */
            $m_control =  $resources->generate_data_update($request, $io->lampiran_pendaftaran->id);
            /*
            | end
            */
            try {
                if (!empty($m_control['data']['foto_formal'])) {
                    $user = \App\Models\User::find(auth()->user()->id);
                    $user->foto = $m_control['data']['foto_formal'];
                    $user->save();
                }
            } catch (\Throwable $th) {
            }
            return response()->json($m_control, $m_control["status"] ?? 400);
        }
    }
    public function getAgent(Request $request)
    {
        $agent = \Modules\V1\Entities\Agent::where('referal', $request->referal)->first();
        if ($agent) {
            return response()->json($agent, 200);
        } else {
            return response()->json([], 401);
        }
    }
    public function addReferal(Request $request)
    {
        try {
            $agent = \Modules\V1\Entities\Agent::where('referal', $request->referal)->first();
            $ref = \Modules\V1\Entities\Pendaftaran::whereuserId(auth()->user()->id)->with("calon_mahasiswa")->first();
            $ref->agent_id = $agent->id;
            $ref->save();
            if (!empty($ref->calon_mahasiswa)) {
                $data = [
                    "email" => User::whereId($agent->user_id)->first()->email,
                    'pesan' => "Calon mahasiswa baru atas nama " . $ref->calon_mahasiswa->nama_lengkap . " telah menambahkan referal anda.",
                ];
                dispatch(new \App\Jobs\JobMessage($data));
            }

            return response()->json([], 200);
        } catch (\Throwable $th) {
            return response()->json([], 401);
        }
    }
    public function read()
    {
        $cmhs = \Modules\V1\Entities\Pendaftaran::where("user_id", auth()->user()->id)->with(["calon_mahasiswa", "calon_mahasiswa.orangtua"])->first();
        return response()->json($cmhs);
    }
}
