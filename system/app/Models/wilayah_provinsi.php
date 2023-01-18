<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class wilayah_provinsi extends Model
{
    use HasFactory;
    protected $connection = 'wilayah';
    protected $table = "wilayah_provinsi";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $fillable = [
        "nama_provinsi"
    ];

    public function kabupaten()
    {
        return $this->hasMany(wilayah_kabupaten::class, 'provinsi_id', 'id');
    }
}
