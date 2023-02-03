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
                    return $query->with(["prodi", "informasi_pendaftaran"]);
                }
            ])
            ->whereHas('pendaftaran', function ($query) use ($request) {
                $Q = $query;
                if (!empty($request->get("prodi"))) {
                    $Q = $Q->where("prodi_id", $request->get("prodi"));
                }
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




        $infoPendaftaran = \Modules\V1\Entities\InformasiPendaftaran::orderBy("created_at", "DESC")->get();

        $thn_ajaran = [];
        foreach ($infoPendaftaran as $ta) {
            $thn_ajaran[$ta->tahun_ajaran] = $ta->tahun_ajaran;
        }
        if (!empty($thn_ajaran))
            $thn_ajaran = array_keys($thn_ajaran);

        if ($request->prodi) {
            $status = [
                "all" => "Daftar",
                "pending" => "Belum Diproses",
                "valid" => "Valid",
                "invalid" => "Invalid",
                "lulus" => "Lulus",
                "tidak_lulus" => "Tidak Lulus",
                "daftar_ulang" => "Daftar Ulang",
            ];
            $head = [];
            $xy = new stdClass();
            foreach ($status as $st => $v) {
                if (!$request->{$st})
                    continue;
                $head[$st] = $v;
                $xy->{$st} =  $pmb->map(function ($z) {
                    return $z->pendaftaran;
                })->groupBy("prodi.nama_prodi")->map(function ($x, $key) use ($st) {
                    return $x->map(function ($cmhs) use ($st) {
                        if ($st == "all")
                            return "all";
                        if ($cmhs->status == $st)
                            return $cmhs->status;
                        return false;
                    })->reject(function ($value) {
                        return $value === false;
                    })->count();
                });
            }
            $U = [];
            foreach ($xy as $ky => $sts) {
                foreach ($sts as $_ky => $_sts) {
                    $U[$_ky][$ky] = $_sts;
                }
            }
            // dd($U);
            $data = [
                "result" => $U,
                "head" => $head
            ];
            return view("report.pmb_report", $data);
        }

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
        foreach ($resData as $key => $colec) {
            $def = [
                'nik' => $colec->nik,
                'nis' => $colec->nis,
                'npwp' => $colec->npwp,
                'nama_lengkap' => $colec->nama_lengkap,
                'jenis_kelamin' => $colec->jenis_kelamin,
                'tempat_lahir' => $colec->tempat_lahir,
                'tanggal_lahir' => $colec->tanggal_lahir,
                'agama' => $colec->agama,
                'no_telepon' => $colec->no_telepon,
                'asal_sekolah' => $colec->asal_sekolah,
                'tahun_lulus' => $colec->tahun_lulus,
                'alamat_lengkap' => $colec->alamat_lengkap,
                'provinsi' => $colec->provinsi,
                'kabupaten' => $colec->kabupaten,
                'kecamatan' => $colec->kecamatan,
                'kelurahan' => $colec->kelurahan,
                'kode_pos' => $colec->kode_pos,
                'nama_ayah' => $colec->orangtua->nama_ayah,
                'tempat_lahir_ayah' => $colec->orangtua->tempat_lahir_ayah,
                'tanggal_lahir_ayah' => $colec->orangtua->tanggal_lahir_ayah,
                'no_telepon_ayah' => $colec->orangtua->no_telepon_ayah,
                'pekerjaan_ayah' => $colec->orangtua->pekerjaan_ayah,
                'penghasilan_ayah' => $colec->orangtua->penghasilan_ayah,
                'alamat_lengkap_ayah' => $colec->orangtua->alamat_lengkap_ayah,
                'nama_ibu' => $colec->orangtua->nama_ibu,
                'tempat_lahir_ibu' => $colec->orangtua->tempat_lahir_ibu,
                'tanggal_lahir_ibu' => $colec->orangtua->tanggal_lahir_ibu,
                'no_telepon_ibu' => $colec->orangtua->no_telepon_ibu,
                'pekerjaan_ibu' => $colec->orangtua->pekerjaan_ibu,
                'penghasilan_ibu' => $colec->orangtua->penghasilan_ibu,
                'alamat_lengkap_ibu' => $colec->orangtua->alamat_lengkap_ibu,
            ];
            array_push($mdata, $def);
        }
        return Excel::download(new CalonMahasiswa($mdata), "export" . date("YmdHis") . ".xlsx");
    }
    public function IdCard(Request $request)
    {
        // try {
        if (!$pendaftaran = \Modules\V1\Entities\Pendaftaran::whereUserId(auth()->user()->id)->with("calon_mahasiswa")->first())
            abort(404);
        $data = [
            "pendaftaran" => $pendaftaran,
            "logo" => asset("assets\logo\logo.png")
        ];
        $customPaper = array(0, 0, 250, 290);
        $pdf = PDF::loadView('report/pmb_idcard', $data)->setPaper($customPaper, 'landscape');
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
