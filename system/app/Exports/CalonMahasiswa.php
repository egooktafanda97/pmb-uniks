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
            'nik',
            'nis',
            'npwp',
            'nama_lengkap',
            'jenis_kelamin',
            'tempat_lahir',
            'tanggal_lahir',
            'agama',
            'no_telepon',
            'asal_sekolah',
            'tahun_lulus',
            'alamat_lengkap',
            'provinsi',
            'kabupaten',
            'kecamatan',
            'kelurahan',
            'kode_pos',
            'nama_ayah',
            'tempat_lahir_ayah',
            'tanggal_lahir_ayah',
            'no_telepon_ayah',
            'pekerjaan_ayah',
            'penghasilan_ayah',
            'alamat_lengkap_ayah',
            'nama_ibu',
            'tempat_lahir_ibu',
            'tanggal_lahir_ibu',
            'no_telepon_ibu',
            'pekerjaan_ibu',
            'penghasilan_ibu',
            'alamat_lengkap_ibu',
        ];
    }
}
