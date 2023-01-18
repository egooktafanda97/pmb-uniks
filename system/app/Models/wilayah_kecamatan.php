<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah_kecamatan extends Model
{
    use HasFactory;
    protected $connection = 'wilayah';
    protected $table = "wilayah_kecamatan";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "kabupaten_id",
        "nama_kecamatan",
        "ibukota_kecamatan"
    ];

    public function kabupaten()
    {
        return $this->belongsTo(wilayah_kabupaten::class, 'kabupaten_id', 'id');
    }
    public function kelurahan()
    {
        return $this->hasMany(wilayah_kelurahan::class, 'kecamatan_id', 'id');
    }
}
