<?php

namespace App\Http\Controllers\admin;

use App\Exports\CalonMahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
use stdClass;

use App\Exports\SiswaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\ManagementControlGetData;
use Pdf;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
    }
    public function report_cmhs(Request $request)
    {
        $prodi = \Modules\V1\Entities\Prodi::orderBy("id", "desc")->get();
        $search = $request->get('search');
        $pendaftaran_active = \Modules\V1\Entities\InformasiPendaftaran::whereStatus("active")->first();
        $pmb = \Modules\V1\Entities\CalonMahasiswa::query()
            ->where(function ($q) use ($search) {
                $q->orWhere("nama_lengkap", "like", "%" . $search . "%");
                $q->orWhere("nik", "like", "%" . $search . "%");
            })
            ->with([
                "orangtua", "pendaftaran" => function ($query) {
                    return $query->with(["prodi", "informasi_pendaftaran", "pilihan_prodi"]);
                }
            ])
            ->whereHas('pendaftaran', function ($query) use ($request) {
                $Q = $query;
                // if (!empty($request->get("prodi"))) {
                //     $Q = $Q->where("prodi_id", $request->get("prodi"));
                // }
                if (!empty($request->status)) {
                    $Q = $Q->where("status", $request->get("status"));
                }
            })
            ->whereHas('pendaftaran.informasi_pendaftaran', function ($query) use ($request) {
                $Q = $query;

                if (!empty($request->get("informasi_pendaftaran"))) {
                    $Q = $Q->where("id", $request->get("informasi_pendaftaran"));
                }
                if (!empty($request->get("tahun_ajaran"))) {
                    $Q = $Q->where("tahun_ajaran", $request->get("tahun_ajaran"));
                }
            });
        if (!empty($pendaftaran_active) && empty($request)) {
            $pmb =   $pmb->whereHas('pendaftaran.informasi_pendaftaran', function ($query) use ($pendaftaran_active) {
                $query->where("id", $pendaftaran_active->id);
            });
        }

        $pmb = $pmb->get();

        $status = [
            "all" => "Daftar",
            "pending" => "Belum Diproses",
            "valid" => "Valid",
            "invalid" => "Invalid",
            "lulus" => "Lulus",
            "tidak_lulus" => "Tidak Lulus",
            "daftar_ulang" => "Daftar Ulang",
        ];
        $prod = $request->cluster;
        $x = $pmb->groupBy("pendaftaran.status")->map(function ($U) use ($prod) {
            return $U->map(function ($y) use ($prod) {
                return $y->pendaftaran->pilihan_prodi()->where("no_pilihan", $prod)->with("prodi")->first();
            })->groupBy("prodi.nama_prodi")->map->count();
        });
        $dd = [];
        $head = [];
        $prr =  \Modules\V1\Entities\Prodi::all();
        foreach ($prr as $pxx) {
            $dd[$pxx->nama_prodi] = [];
        }
        foreach ($x as $claster_status => $val) {
            if (!$request->{$claster_status})
                continue;
            $head[$claster_status] =  $status[$claster_status];
            foreach ($prr  as $p) {
                $st = $claster_status;
                $prd = $p->nama_prodi;
                if (!empty($val[$p->nama_prodi])) {
                    $vals = $val[$p->nama_prodi];
                    $dd[$prd] += [$st => $vals];
                } else {
                    $dd[$prd] += [$st => 0];
                }
            }
        }
        // $head = [];
        // $xy = new stdClass();

        // foreach ($status as $st => $v) {
        //     if (!$request->{$st})
        //         continue;
        //     $head[$st] = $v;
        //     $xy->{$st} = $pmb->map(function ($z) {
        //         return $z->pendaftaran->pilihan_prodi()->where('no_pilihan', '1')->with("prodi")->get();
        //     });
        //     $_x = $pmb->map(function ($z) {
        //         return $z->pendaftaran->pilihan_prodi()->where('no_pilihan', '1')->with("prodi")->get();
        //     })->map->groupBy("prodi.nama_prodi")->map(function ($x, $key) use ($st) {

        //     });
        //     return response()->json($_x);

        //     // ->groupBy("pilihan_prodi")->map(function ($x, $key) use ($st) {
        //     //     return $x->map(function ($cmhs) use ($st) {
        //     //         if ($st == "all")
        //     //             return "all";
        //     //         if ($cmhs->status == $st)
        //     //             return $cmhs->status;
        //     //         return false;
        //     //     })->reject(function ($value) {
        //     //         return $value === false;
        //     //     })->count();
        //     // });
        // }
        // $U = [];
        // foreach ($xy as $ky => $sts) {
        //     foreach ($sts as $_ky => $_sts) {
        //         $U[$_ky][$ky] = $_sts;
        //     }
        // }
        $data = [
            "result" => $dd,
            "head" => $head,
            "info_pendaftaran" => $pendaftaran_active
        ];
        return view("report.pmb_report", $data);

        // return [
        //     "prodi" => $prodi,
        //     "mhs" => $pmb,
        //     "info_pendaftaran" => $infoPendaftaran,
        //     "tahun_ajaran" => $thn_ajaran
        // ];

    }

    public function report_excel(Request $request)
    {
        $data = ManagementControlGetData::result_query_dump_pmb($request, false);
        $resData = $data["mhs"]->map(function ($x) {
            $x->provinsi = \App\Clases\Hold::wilayah("provinsi", $x->provinsi);
            $x->kabupaten = \App\Clases\Hold::wilayah("kab",  $x->kabupaten);
            $x->kecamatan = \App\Clases\Hold::wilayah("kec", $x->kecamatan);
            $x->kelurahan = \App\Clases\Hold::wilayah("kel", $x->kelurahan);
            $x->jenis_kelamin = $x->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan";
            return $x;
        });
        $mdata = [];
        foreach ($resData as $key => $daftar) {
            $ortu = $daftar->orangtua;
            $def = [
                "NIK" =>  $daftar->nik,
                "NIS" =>  $daftar->nis,
                "NAMA LENGKAP" =>  $daftar->nama_lengkap,
                "JENIS KELAMIN" =>  $daftar->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan" ?? "",
                "TEMPAT LAHIR" =>  $daftar->tempat_lahir,
                "TANGGAL LAHIR" =>  tgl_i($daftar->tanggal_lahir),
                "STATUS PERKAWINAN" =>  $daftar->status_perkawinan,
                "KEWARGA NEGARAAAN" =>  $daftar->kewarga_negaraan,
                "AGAMA" =>  $daftar->agama,
                "NO TELEPON" =>  $daftar->no_telepon,
                "JENIS SLTA" => $daftar->jenis_slta,
                "ASAL SLTA" => $daftar->asal_slta,
                "TAHUN IJAZAH" => $daftar->tahun_ijazah,
                "NOMOR IJAZAH" => $daftar->no_ijazah,
                "SUMBER BIAYA KULIAH TERBESAR" => $daftar->sumber_biaya_kuliah,
                "PENGHASILAN ORANGTUA / BULAN" => $daftar->penghasilan_orangtua,
                "ALAMAT LENGKAP" =>  $daftar->alamat_lengkap,
                "PROVINSI" =>  \App\Models\wilayah_provinsi::find($daftar->provinsi)->nama ?? "-",
                "KABUPATEN" =>  \App\Models\wilayah_kabupaten::find($daftar->kabupaten)->nama ?? "-",
                "KECAMATAN" =>  \App\Models\wilayah_kecamatan::find($daftar->kecamatan)->nama ?? "",
                "KELURAHAN / DESA" =>  \App\Models\wilayah_kelurahan::find($daftar->kelurahan)->nama ?? "",
                "KODE POS" =>  $daftar->kode_pos,
                "JALUR PENDAFTARAN" => $daftar->jalur_pendaftaran,
                "MEMILIKI KARTU" => $daftar->jalur_pendaftaran == 'kip-k' ? $daftar->memiliki_kartu : "",
                "KATEGORI PERGURUAN TINGGI" => $daftar->jalur_pendaftaran == 'alih_jenjang' ? $daftar->kategori_pt : "",
                "PERGURUA TINGGI SEBELUMNYA" => $daftar->jalur_pendaftaran == 'alih_jenjang' ? $daftar->pt_sebelumnya : "",
                "IJAZAH YANG DI PEROLEH" => $daftar->jalur_pendaftaran == 'alih_jenjang' ? $daftar->ijazah_diperolah : "",
                "JUMLAH SKS" => $daftar->jalur_pendaftaran == 'alih_jenjang' ? $daftar->jml_sks : "",
                "NAMA AYAH" => $ortu->nama_ayah ?? "",
                "TEMPAT LAHIR AYAH" => $ortu->tempat_lahir_ayah ?? "",
                "TANGGAL LAHIR AYAH" => $ortu->tanggal_lahir_ayah ?? "",
                "NO TELEPON AYAH" => $ortu->no_telepon_ayah ?? "",
                "ALAMAT LENGKAP AYAH" => $ortu->alamat_lengkap_ayah ?? "",
                "NAMA IBU" => $ortu->nama_ibu ?? "",
                "TEMPAT LAHIR IBU" => $ortu->tempat_lahir_ibu ?? "",
                "TANGGAL LAHIR IBU" => $ortu->tanggal_lahir_ibu ?? "",
                "NO TELEPON IBU" => $ortu->no_telepon_ibu ?? "",
                "ALAMAT LENGKAP IBU" => $ortu->alamat_lengkap_ibu ?? "",
            ];
            array_push($mdata, $def);
        }
        return Excel::download(new CalonMahasiswa($mdata), "export" . date("YmdHis") . ".xlsx");
    }
    public function IdCard(Request $request)
    {
        // try {
        if (!$pendaftaran = \Modules\V1\Entities\Pendaftaran::whereUserId(auth()->user()->id)->with("calon_mahasiswa", "pilihan_prodi", "informasi_pendaftaran", "lampiran_pendaftaran")->first())
            abort(404);
        $data = [
            "pendaftaran" => $pendaftaran,
            "logo" => asset("assets\logo\logo.png")
        ];
        $customPaper = array(0, 0, 250, 290);
        $PDFOptions = ['enable_remote' => true, 'isRemoteEnabled', true];
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])->loadView('report/pmb_idcard', $data)->setPaper($customPaper, 'landscape');
        return $pdf->stream();
        // return view("report/pmb_idcard", $data);
        // $data = ['title' => 'Welcome to belajarphp.net'];
        // $pdf = PDF::loadView("report/pmb_idcard", $data);
        // return $pdf->stream();
        // } catch (\Throwable $th) {
        //     abort(404);
        // }
    }
}
