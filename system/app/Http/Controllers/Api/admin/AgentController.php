<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
use Modules\V1\Providers\ManagementServiceProvider;

class AgentController extends Controller
{
    private static $incam = [
        "validasi" => 50000,
        "daftar_ulang" => 100000
    ];
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['']]);
    }

    public static function data_detail_agent($status, $id)
    {
        try {
            $Agent = \Modules\V1\Entities\Agent::where('id', $id)
                ->whereHas("pendaftaran", function ($q) use ($status) {
                    $q->whereHas("informasi_pendaftaran", function ($query) use ($status) {
                        if (empty($status)) {
                            $query->where("status", "active");
                        } else {
                            $query->where("id", $status);
                        }
                    });
                })
                ->with("pendaftaran", function ($q) {
                    return $q->with(['informasi_pendaftaran', 'calon_mahasiswa']);
                })
                ->with("riwayat_pencairan_agent")
                ->first();

            $__logik = $Agent
                ->pendaftaran->map(function ($qq) {
                    $Q = $qq;
                    $Q->group_status = $Q->status != 'pending' && $Q->status != 'daftar_ulang' ? 'adminitrasi' : ($Q->status == 'daftar_ulang' ? 'daftar_ulang' : false);
                    return $Q->group_status == false ? false : $Q;
                })->reject(function ($value) {
                    return $value === false;
                })->groupBy('group_status');
            $Agent->claster = $__logik;
            $Agent->count_cmhs = $__logik->map->count();

            $Agent->penarikan = (int)$Agent->riwayat_pencairan_agent->sum('jml_pencairan') ?? 0;
            $v = (!empty($Agent->count_cmhs['adminitrasi']) ? (int)$Agent->count_cmhs['adminitrasi'] : 0) * self::$incam['validasi'];
            $du = (!empty($Agent->count_cmhs['daftar_ulang']) ? (int)$Agent->count_cmhs['daftar_ulang'] : 0) * self::$incam['daftar_ulang'];
            $Agent->total_income = (int)($v + $du);
            $Agent->income = (int)($v + $du) - (int)$Agent->penarikan;

            return $Agent;
        } catch (\Throwable $th) {
            $Agent = \Modules\V1\Entities\Agent::where('id', $id)
                ->whereHas("pendaftaran", function ($q) use ($status) {
                    return $q
                        ->whereHas('informasi_pendaftaran', function ($query) use ($status) {
                            if (empty($status)) {
                                $query->where("status", "active");
                            } else {
                                $query->where("id", $status);
                            }
                        }, 'calon_mahasiswa');
                })
                ->with("riwayat_pencairan_agent")
                ->first();
            return $Agent;
        }
    }
    public function api_pencairan(Request $request)
    {
        $resources = new ManagementCrud('RiwayatPencairanAgent');
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $resources->instance($pathJson);
        $resources->setNameSpaceModel("\Modules\V1\Entities\\");

        $i = $request->info_pendaftaran_id ?? \Modules\V1\Entities\InformasiPendaftaran::where('status', 'active')->first()->id;

        $ag = $this->data_detail_agent($i, $request->agent_id);

        if ((int)$request->jumlah > (int)$ag->income) {
            return response()->json(["error" => "jumlah yang dicairkan lebih dari yang pendapatan"], 402);
        }

        $req = new \Illuminate\Http\Request();
        $req->replace([
            "agent_id" => $request->agent_id,
            "informasi_pendaftaran_id" => $request->info_pendaftaran_id,
            "jml_pencairan" => $request->jumlah,
            "catatan" => ""
        ]);

        $save =  $resources->generate_data_insert($req);

        return response()->json($save);
    }
}
