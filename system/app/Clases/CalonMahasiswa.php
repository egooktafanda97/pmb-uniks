<?php

namespace App\Clases;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CalonMahasiswa
{
    public function info_description($data)
    {
        $daftar = $data['pendaftaran']->calon_mahasiswa;
        $ortu = $data['pendaftaran']->calon_mahasiswa->orangtua;
        return [
            "jalur" => [
                "JALUR PENDAFTARAN" => $daftar->jalur_pendaftaran,
                "MEMILIKI KARTU" => $daftar->jalur_pendaftaran == 'kip-k' ? $daftar->memiliki_kartu : false,
                "KATEGORI PERGURUAN TINGGI" => $daftar->jalur_pendaftaran == 'alih_jenjang' ? $daftar->kategori_pt : false,
                "PERGURUA TINGGI SEBELUMNYA" => $daftar->jalur_pendaftaran == 'alih_jenjang' ? $daftar->pt_sebelumnya : false,
                "IJAZAH YANG DI PEROLEH" => $daftar->jalur_pendaftaran == 'alih_jenjang' ? $daftar->ijazah_diperolah : false,
                "JUMLAH SKS" => $daftar->jalur_pendaftaran == 'alih_jenjang' ? $daftar->jml_sks : false,
            ],
            "c_mhs" => [
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
            ],
            "ayah" => [
                "NAMA" => $ortu->nama_ayah ?? "",
                "TEMPAT LAHIR" => $ortu->tempat_lahir_ayah ?? "",
                "TANGGAL LAHIR" => $ortu->tanggal_lahir_ayah ?? "",
                "NO TELEPON" => $ortu->no_telepon_ayah ?? "",
                "ALAMAT LENGKAP" => $ortu->alamat_lengkap_ayah ?? "",
            ],
            "ibu" => [
                "NAMA" => $ortu->nama_ibu ?? "",
                "TEMPAT LAHIR" => $ortu->tempat_lahir_ibu ?? "",
                "TANGGAL LAHIR" => $ortu->tanggal_lahir_ibu ?? "",
                "NO TELEPON" => $ortu->no_telepon_ibu ?? "",
                "ALAMAT LENGKAP" => $ortu->alamat_lengkap_ibu ?? "",
            ]
        ];
    }
}
