<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

trait ManagementControlGetData
{
    private static $incam = [
        "validasi" => 50000,
        "daftar_ulang" => 100000
    ];
    public static function result_query_dump_data()
    {
        $fakultas = \Modules\V1\Entities\Fakultas::all();
        $prodi = \Modules\V1\Entities\Prodi::all();
        $Infopendaftaran =  \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->first();

        $p1 = [];
        $p2 = [];
        $count_prodi = [];
        foreach ($prodi as  $value) {
            if ($Infopendaftaran) {
                $_p1 = \Modules\V1\Entities\Pendaftaran::whereHas('pilihan_prodi', function ($q) use ($value) {
                    $q->where('no_pilihan', '1');
                    $q->where("prodi_id", $value->id);
                })->get()->count();
                $_p2 = \Modules\V1\Entities\Pendaftaran::whereHas('pilihan_prodi', function ($q) use ($value) {
                    $q->where('no_pilihan', '2');
                    $q->where("prodi_id", $value->id);
                })->get()->count();
                // $pendaftar2 = \Modules\V1\Entities\Pendaftaran::where('prodi_id', $value->id)->where("status", 'valid')->where('informasi_pendaftaran_id', $Infopendaftaran->id)->with("prodi")->get()->count() ?? 0;
                // $pendaftar3 = \Modules\V1\Entities\Pendaftaran::where('prodi_id', $value->id)->where("status", 'invalid')->where('informasi_pendaftaran_id', $Infopendaftaran->id)->with("prodi")->get()->count() ?? 0;
                $p1[] = $_p1;
                $p2[] = $_p2;
                // $pendaftaran_valid[] = $pendaftar2;
                // $pendaftaran_invalid[] =  $pendaftar3;

                $count_prodi[] = $value->nama_alias;
            } else {
                $p1[] = 0;
                $count_prodi[] = $value->nama_alias;
            }
        }

        return [
            "fakultas" => $fakultas,
            "prodi" => $prodi,
            "pendaftaran" => [
                "info_pendaftaran" => !empty($Infopendaftaran) ? $Infopendaftaran : [],
                "pendaftar" => !empty($Infopendaftaran) ? $Infopendaftaran->pendaftar->count() : 0,
                "pendaftar_pending" => !empty($Infopendaftaran) ? $Infopendaftaran->pendaftar()->where("status", 'pending')->get()->count() : 0,
                "pendaftar_valid" => !empty($Infopendaftaran) ? $Infopendaftaran->pendaftar()->where("status", 'valid')->get()->count() : 0,
                "pendaftar_invalid" => !empty($Infopendaftaran) ? $Infopendaftaran->pendaftar()->where("status", 'invalid')->get()->count() : 0,
                "group_prodi" => [
                    "prodi" => $count_prodi,
                    "pilihan_1" =>  $p1,
                    "pilihan_2" => $p2
                ]
            ]
        ];
    }
    public static function result_query_dump_agent($request = null)
    {
        $Agent = \Modules\V1\Entities\Agent::orderBy("id", "DESC")
            ->whereHas("pendaftaran", function ($q) use ($request) {
                $q->whereHas("informasi_pendaftaran", function ($query) use ($request) {
                    if (empty($request->informasi_pendaftaran)) {
                        $query->where("status", "active");
                    } else {
                        $query->where("id", $request->informasi_pendaftaran);
                    }
                });
            })
            ->with("pendaftaran")
            ->with("riwayat_pencairan_agent")
            ->get();
        $results = $Agent
            ->map(function ($q) {
                $QR = $q;
                $__logik = $q->pendaftaran->map(function ($qq) {
                    $Q = $qq;
                    $Q->group_status = $Q->status != 'pending' && $Q->status != 'daftar_ulang' ? 'adminitrasi' : ($Q->status == 'daftar_ulang' ? 'daftar_ulang' : false);
                    return $Q->group_status == false ? false : $Q;
                })->reject(function ($value) {
                    return $value === false;
                })->groupBy('group_status');
                $QR->claster = $__logik;
                $QR->count_cmhs = $__logik->map->count();
                return $QR;
            })
            ->map(function ($inc) {
                $iQ = $inc;
                $iQ->penarikan = (int)$inc->riwayat_pencairan_agent->sum('jml_pencairan') ?? 0;
                $v = (!empty($iQ->count_cmhs['adminitrasi']) ? (int)$iQ->count_cmhs['adminitrasi'] : 0) * self::$incam['validasi'];
                $du = (!empty($iQ->count_cmhs['daftar_ulang']) ? (int)$iQ->count_cmhs['daftar_ulang'] : 0) * self::$incam['daftar_ulang'];
                $iQ->total_income = (int)($v + $du);
                $iQ->income = (int)($v + $du) - (int)$iQ->penarikan;
                return $iQ;
            });
        return  $results;
    }
    public static function result_query_dump_pmb($request, $paging = true)
    {
        $prodi = \Modules\V1\Entities\Prodi::orderBy("id", "desc")->get();
        $search = $request->search;
        $pendaftaran_active = \Modules\V1\Entities\InformasiPendaftaran::whereStatus("active")->first();

        $pmb = \Modules\V1\Entities\CalonMahasiswa::query()
            ->orderBy("created_at", "DESC")
            ->where(function ($q) use ($search) {
                $q->orWhere("nama_lengkap", "like", "%" . $search . "%");
                $q->orWhere("nik", "like", "%" . $search . "%");
            })
            ->with([
                "orangtua", "pendaftaran" => function ($query) {
                    return $query->with(["prodi", "informasi_pendaftaran"]);
                }
            ])
            ->whereHas('pendaftaran', function ($query) use ($request) {
                $Q = $query;
                if (!empty($request->prodi)) {
                    $Q = $Q->where("prodi_id", $request->prodi);
                }
                if (!empty($request->status)) {
                    $Q = $Q->where("status", $request->status);
                }
            })
            ->whereHas('pendaftaran.informasi_pendaftaran', function ($query) use ($request) {
                $Q = $query;

                if (!empty($request->informasi_pendaftaran)) {
                    $Q = $Q->where("id", $request->informasi_pendaftaran);
                }
                if (!empty($request->tahun_ajaran)) {
                    $Q = $Q->where("tahun_ajaran", $request->tahun_ajaran);
                }
            });
        if (!empty($pendaftaran_active) && empty($request->all())) {
            $pmb =   $pmb->whereHas('pendaftaran.informasi_pendaftaran', function ($query) use ($pendaftaran_active) {
                $query->where("id", $pendaftaran_active->id);
            });
        }
        if ($paging) {
            $pmb = $pmb->paginate(20);
        } else {
            $pmb = $pmb->get();
        }



        $infoPendaftaran = \Modules\V1\Entities\InformasiPendaftaran::orderBy("created_at", "DESC")->get();

        $thn_ajaran = [];
        foreach ($infoPendaftaran as $ta) {
            $thn_ajaran[$ta->tahun_ajaran] = $ta->tahun_ajaran;
        }
        if (!empty($thn_ajaran))
            $thn_ajaran = array_keys($thn_ajaran);

        return [
            "prodi" => $prodi,
            "mhs" => $pmb,
            "info_pendaftaran" => $infoPendaftaran,
            "tahun_ajaran" => $thn_ajaran
        ];
    }
}
