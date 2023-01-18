<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah_kabupaten extends Model
{
    use HasFactory;
    protected $connection = 'wilayah';
    protected $table = "wilayah_kabupaten";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $fillable = [
        "provinsi_id",
        "nama_kabupaten"
    ];
    public function provinsi()
    {
        return $this->belongsTo(wilayah_provinsi::class, 'provinsi_id', 'id');
    }
    public function kecamatan()
    {
        return $this->hasMany(wilayah_kecamatan::class, 'kabupaten_id', 'id');
    }
}
