<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CalonMahasiswa implements FromCollection, WithHeadings
{
    use Exportable;
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            "NIK",
            "NIS",
            "NAMA LENGKAP",
            "JENIS KELAMIN",
            "TEMPAT LAHIR",
            "TANGGAL LAHIR",
            "STATUS PERKAWINAN",
            "KEWARGA NEGARAAAN",
            "AGAMA",
            "NO TELEPON",
            "JENIS SLTA",
            "ASAL SLTA",
            "TAHUN IJAZAH",
            "NOMOR IJAZAH",
            "SUMBER BIAYA KULIAH TERBESAR",
            "PENGHASILAN ORANGTUA / BULAN",
            "ALAMAT LENGKAP",
            "PROVINSI",
            "KABUPATEN",
            "KECAMATAN",
            "KELURAHAN / DESA",
            "KODE POS",
            "JALUR PENDAFTARAN",
            "MEMILIKI KARTU",
            "KATEGORI PERGURUAN TINGGI",
            "PERGURUA TINGGI SEBELUMNYA",
            "IJAZAH YANG DI PEROLEH",
            "JUMLAH SKS",
            "NAMA AYAH",
            "TEMPAT LAHIR AYAH",
            "TANGGAL LAHIR AYAH",
            "NO TELEPON AYAH",
            "ALAMAT LENGKAP AYAH",
            "NAMA IBU",
            "TEMPAT LAHIR IBU",
            "TANGGAL LAHIR IBU",
            "NO TELEPON IBU",
            "ALAMAT LENGKAP IBU",
        ];
    }
}
