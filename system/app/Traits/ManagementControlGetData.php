<?php

namespace App\Traits;

trait ManagementControlGetData
{
    public static function result_query_dump_data()
    {
        $fakultas = \Modules\V1\Entities\Fakultas::all();
        $prodi = \Modules\V1\Entities\Prodi::all();
        $Infopendaftaran =  \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->first();

        $pendaftaran_pending = [];
        $pendaftaran_valid = [];
        $pendaftaran_invalid = [];
        $count_prodi = [];
        foreach ($prodi as  $value) {
            if ($Infopendaftaran) {
                $pendaftar1 = \Modules\V1\Entities\Pendaftaran::where('prodi_id', $value->id)->where("status", 'pending')->where('informasi_pendaftaran_id', $Infopendaftaran->id)->with("prodi")->get()->count() ?? 0;
                $pendaftar2 = \Modules\V1\Entities\Pendaftaran::where('prodi_id', $value->id)->where("status", 'valid')->where('informasi_pendaftaran_id', $Infopendaftaran->id)->with("prodi")->get()->count() ?? 0;
                $pendaftar3 = \Modules\V1\Entities\Pendaftaran::where('prodi_id', $value->id)->where("status", 'invalid')->where('informasi_pendaftaran_id', $Infopendaftaran->id)->with("prodi")->get()->count() ?? 0;
                $pendaftaran_pending[] = $pendaftar1;
                $pendaftaran_valid[] = $pendaftar2;
                $pendaftaran_invalid[] =  $pendaftar3;
                $count_prodi[] = $value->nama_alias;
            } else {
                $pendaftaran_pending[] = 0;
                $pendaftaran_valid[] = 0;
                $pendaftaran_invalid[] =  0;
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
                    "data" => !empty($Infopendaftaran) ? $Infopendaftaran->pendaftar()->with("prodi")->get()->groupBy('prodi.nama_prodi') : [],
                    "count" => !empty($Infopendaftaran) ? $Infopendaftaran->pendaftar()->with("prodi")->get()->groupBy('prodi.nama_prodi')->map->count() : 0,
                    "prodi" => $count_prodi,
                    "data_pending" =>  $pendaftaran_pending,
                    "data_valid" => $pendaftaran_valid,
                    "data_invalid" =>  $pendaftaran_invalid
                ]
            ]
        ];
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
