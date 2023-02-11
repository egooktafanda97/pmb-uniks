<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class AgentController extends Controller
{
    public $data;
    private static $incam = [
        "validasi" => 50000,
        "daftar_ulang" => 100000
    ];
    private $view = "admin.page.Agent.";
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
        $data = new ManagementCrud("Agent");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->data = $data;
    }
    public function generate_referal()
    {
        $referal = \Modules\V1\Entities\Agent::orderBy("id", "DESC")->first();
        if (!empty($referal)) {
            $x = explode("-", $referal->referal);
            $y =  (int)$x[1] + 1;
            $res = "AG-" . str_pad($y, 3, '0', STR_PAD_LEFT);
        } else {
            $res = "AG-0001";
        }
        return $res;
    }
    public function getData()
    {
        $agent = \Modules\V1\Entities\Agent::orderBy('id', 'desc')->paginate(10);
        return [
            "agent" => $agent,
            "sub_title"    => "Data Agent",
            "title" => "Tables",
            "uri" => $this->data->getRouterWeb() ?? []
        ];
    }
    public function show()
    {
        $data =  $this->getData();
        return view($this->view . 'index', $data);
    }
    public function store()
    {
        $data = [
            "title" => "Input",
            "sub_title" => "Buat Pendaftran Baru",
            "fakultas" => \Modules\V1\Entities\Agent::all(),
            "referal" => $this->generate_referal(),
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'input', $data);
    }
    public function update($id)
    {
        $d = \Modules\V1\Entities\Agent::whereId($id)->with("users")->first();
        $data = [
            "title" => "Input",
            "sub_title" => "Pengumuman",
            "agents" => $d,
            "referal" => $d->referal,
            "uri" => $this->data->getRouterWeb() ?? [],
        ];
        return view($this->view . 'input', $data);
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
    public function detail(Request $request, $id)
    {
        $i = $request->informasi_pendaftaran ?? \Modules\V1\Entities\InformasiPendaftaran::where('status', 'active')->first()->id;
        $xi = \Modules\V1\Entities\InformasiPendaftaran::whereId($i)->first();
        $inf_p = \Modules\V1\Entities\InformasiPendaftaran::all();
        $data = [
            "queryes" => $this->data_detail_agent($i, $id) ?? false,
            "info_pendaftaran_id" => $i,
            "info_pendaftaran" => $xi,
            "info_pendaftaran_all" => $inf_p,
            "sub_title"    => "Pendaftaran",
            "title" => "Tables",
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        // return response()->json($data);
        return view($this->view . 'detail', $data);
    }
}
