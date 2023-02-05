<?php

namespace App\Http\Controllers\mahasiswa;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
    }
    public function index()
    {

        $data = $this->getter_data();
        $data["informasi_pendaftaran"] = $this->info_description();
        return view("mahasiswa.page.profile.index", $data);
    }
    public function getter_data()
    {
        $prodi = \Modules\V1\Entities\Prodi::orderBy("id", "desc")->get();
        $pmb = \Modules\V1\Entities\Pendaftaran::whereUserId(Auth::user()->id)->with([
            "users",
            "prodi",
            "informasi_pendaftaran",
            "calon_mahasiswa",
            "agent"
        ])->first();
        return [
            "prodi" => $prodi,
            "pendaftaran" => $pmb
        ];
    }
    public function info_description()
    {
        $data = $this->getter_data();
        $daftar = $data['pendaftaran']->calon_mahasiswa;
        $ortu = $data['pendaftaran']->calon_mahasiswa->orangtua;

        return [
            "c_mhs" => [
                "NIK" =>  $daftar->nik,
                "NIS" =>  $daftar->nis,
                "NPWP" =>  $daftar->npwp,
                "NAMA LENGKAP" =>  $daftar->nama_lengkap,
                "JENIS KELAMIN" =>  $daftar->jenis_kelamin == "L" ? "Laki-Laki" : "Perempuan" ?? "",
                "TEMPAT LAHIR" =>  $daftar->tempat_lahir,
                "TANGGAL LAHIR" =>  $daftar->tanggal_lahir,
                "AGAMA" =>  $daftar->agama,
                "NO TELEPON" =>  $daftar->no_telepon,
                "ASAL SEKOLAH" =>  $daftar->asal_sekolah,
                "TAHUN LULUS" =>  $daftar->tahun_lulus,
                "ALAMAT LENGKAP" =>  $daftar->alamat_lengkap,
                "PROVINSI" =>  \App\Models\wilayah_provinsi::find($daftar->provinsi)->nama ?? "-",
                "KABUPATEN" =>  \App\Models\wilayah_kabupaten::find($daftar->kabupaten)->nama ?? "-",
                "KECAMATAN" =>  \App\Models\wilayah_kecamatan::find($daftar->kecamatan)->nama ?? "",
                "KELURAHAN / DESA" =>  \App\Models\wilayah_kelurahan::find($daftar->kelurahan)->nama ?? "",
                "KODE POS" =>  $daftar->kode_pos,
            ],
            "ayah" => [
                "NAMA" => $ortu->nama_ayah ?? "",
                "TEMPAT LAHIR" => $ortu->tempat_lahir_ayah ?? "",
                "TANGGAL LAHIR" => $ortu->tanggal_lahir_ayah ?? "",
                "NO TELEPON" => $ortu->no_telepon_ayah ?? "",
                "PEKERJAAN" => $ortu->pekerjaan_ayah ?? "",
                "PENGHASILAN" => Helpers::convert_to_rupiah($ortu->penghasilan_ayah ?? ""),
                "ALAMAT LENGKAP" => $ortu->alamat_lengkap_ayah ?? "",
            ],
            "ibu" => [
                "NAMA" => $ortu->nama_ibu ?? "",
                "TEMPAT LAHIR" => $ortu->tempat_lahir_ibu ?? "",
                "TANGGAL LAHIR" => $ortu->tanggal_lahir_ibu ?? "",
                "NO TELEPON" => $ortu->no_telepon_ibu ?? "",
                "PEKERJAAN" => $ortu->pekerjaan_ibu ?? "",
                "PENGHASILAN" => Helpers::convert_to_rupiah($ortu->penghasilan_ibu ?? ""),
                "ALAMAT LENGKAP" => $ortu->alamat_lengkap_ibu ?? "",
            ]
        ];
    }
}
