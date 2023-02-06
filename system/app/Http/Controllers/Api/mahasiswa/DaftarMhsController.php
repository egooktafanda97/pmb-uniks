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
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
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
        $this->middleware('auth:api', ['except' => ['api_register', 'api_register_valids']]);
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
            $pil  = [];
            if (!empty($request->prodi_1))
                array_push($pil, [
                    "no_pilihan" => "1",
                    "pendaftaran_id" => $up_prod->id,
                    "prodi_id" => $request->prodi_1
                ]);
            if (!empty($request->prodi_1) && !empty($request->prodi_2))
                array_push($pil, [
                    "no_pilihan" => "2",
                    "pendaftaran_id" => $up_prod->id,
                    "prodi_id" => $request->prodi_2
                ]);
            foreach ($pil as $plp) {
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
    public function api_register(Request $request)
    {
        $resources = new ManagementCrud(str_replace('Controller', '', "PendaftaranController"));
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $resources->instance($pathJson);
        $resources->setNameSpaceModel("\Modules\V1\Entities\\");

        if (empty($resources))
            return response()->json([
                "error"  => "data not found",
                "status" => 501,
            ], 501);
        $info_pendaftaran = \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->first();

        if (empty($info_pendaftaran))
            return response()->json([
                "error"  => "data not found",
                "status" => 501,
            ], 501);
        try {
            $getNum = \Modules\V1\Entities\Pendaftaran::where("informasi_pendaftaran_id", $info_pendaftaran->id)->orderBy("id", "DESC")->first();
            if (!empty($getNum)) {
                $getNums = explode("-", $getNum->no_resister);
                $noRegPad = 1;
                if (count($getNums) == 2) {
                    $inc = (int) $getNums[1];
                    $counter = $inc + 1;
                    $noRegPad = str_pad($counter, 4, '0', STR_PAD_LEFT);
                    $noreg = "on-" . $noRegPad;
                } else {
                    $noreg = "on-0001";
                }
            } else {
                $noreg = "on-0001";
            }
        } catch (\Throwable $th) {
            $noreg = "on-0001";
        }
        $request->merge(["no_resister" =>  $noreg, "informasi_pendaftaran_id" => $info_pendaftaran->id]);

        $save =  $resources->generate_data_insert($request);

        if (!empty($save['status']) && $save['status'] == 200) {
            /*
            | AKTIFKAN JIKA AKAN MEMBUAT ROLE PADA USER
            */
            $this->create_role_users($save, 'mahasiswa');
            /*
            | end
            */
            $getUs = User::find($save['data']['user_id']);
            $getUs->nama = $request->nama;
            $getUs->foto = "default.jpg";

            $getUs->save();

            $getUs = User::find($save['data']['user_id']);
            $kode = "";
            do {
                $digits = 4;
                $kode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                $cek = \App\Models\Verify::where("key_reference", $kode)->first();
            } while (!empty($cek));

            $created_otp = \App\Models\Verify::create([
                "user_id" => $getUs->id,
                "key_reference" => $kode,
                "key_for" => "verifikai"
            ]);

            $details = [
                "email" => $getUs->email,
                "nama" => $getUs->nama,
                "kode" => $created_otp->key_reference
            ];
            dispatch(new \App\Jobs\SendEmailVerify($details));
            $enc = Crypt::encrypt($getUs->email);

            return response()->json([
                "result"  => $enc
            ], 200);
        } else {
            return response()->json($save, 401);
        }
    }
    public function api_register_valids(Request $request)
    {
        try {
            $resources = new ManagementCrud(str_replace('Controller', '', "PendaftaranController"));
            $pathJson =  ManagementServiceProvider::getScemaPath();
            $resources->instance($pathJson);
            $resources->setNameSpaceModel("\Modules\V1\Entities\\");

            if (empty($resources))
                return response()->json([
                    "error"  => "data not found",
                    "status" => 501,
                ], 501);
            $info_pendaftaran = \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->first();

            if (empty($info_pendaftaran))
                return response()->json([
                    "error"  => "data not found",
                    "status" => 501,
                ], 501);
            try {
                $getNum = \Modules\V1\Entities\Pendaftaran::where("informasi_pendaftaran_id", $info_pendaftaran->id)->orderBy("no_resister")->first();
                if (!empty($getNum)) {
                    $getNums = explode("-", $getNum);
                    $noRegPad = 1;
                    if (count($getNums) == 2) {
                        $inc = (int) $getNums[1];
                        $counter = $inc + 1;
                        $noRegPad = str_pad($counter, 3, '0', STR_PAD_LEFT);
                        $noreg = "on-" . $noRegPad;
                    } else {
                        $noreg = "on-0001";
                    }
                } else {
                    $noreg = "on-0001";
                }
            } catch (\Throwable $th) {
                $noreg = "on-0001";
            }
            $request->merge(["no_resister" =>  $noreg, "informasi_pendaftaran_id" => $info_pendaftaran->id]);

            $save =  $resources->generate_data_insert($request);

            if (!empty($save['status']) && $save['status'] == 200) {
                /*
            | AKTIFKAN JIKA AKAN MEMBUAT ROLE PADA USER
            */
                $this->create_role_users($save, 'mahasiswa');
                /*
            | end
            */
                $getUs = User::find($save['data']['user_id']);
                $getUs->nama = $request->nama;
                $getUs->foto = "default.jpg";
                $getUs->email_verified_at =  now();
                $getUs->save();

                $kode = "";
                do {
                    $digits = 4;
                    $kode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                    $cek = \App\Models\Verify::where("key_reference", $kode)->first();
                } while (!empty($cek));
                \App\Models\Verify::create([
                    "user_id" => $getUs->id,
                    "key_reference" => $kode,
                    "key_for" => "verifikai"
                ]);

                return response()->json([
                    "result" => Crypt::encrypt($kode)
                ], 200);
            } else {
                return response()->json($save, 401);
            }
        } catch (\Throwable $th) {
            return response()->json(false, 501);
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
        $cmhs = \Modules\V1\Entities\Pendaftaran::where("user_id", auth()->user()->id)->with(["calon_mahasiswa", "calon_mahasiswa.orangtua", "pilihan_prodi"])->first();
        return response()->json($cmhs);
    }
}
