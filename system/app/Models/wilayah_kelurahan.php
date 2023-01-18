<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah_kelurahan extends Model
{
    use HasFactory;
    protected $connection = 'wilayah';
    protected $table = "wilayah_kelurahan";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $fillable = [
        "kecamatan_id",
        "nama_kelurahan",
        "ibu_kota_kelurahan",
        "sebutan_kelurahan"
    ];
    public function kecamatan()
    {
        return $this->belongsTo(wilayah_kecamatan::class, 'kecamatan_id', 'id');
    }
}
