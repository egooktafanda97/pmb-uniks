<?php

namespace App\Clases;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Hold
{
    public static function wilayah($name, $id)
    {
        switch ($name) {
            case 'provinsi':
                return \App\Models\wilayah_provinsi::find($id)->nama ?? "-";
                break;
            case 'kab':
                return \App\Models\wilayah_kabupaten::find($id)->nama ?? "-";
                break;
            case 'kec':
                return \App\Models\wilayah_kecamatan::find($id)->nama ?? "";
                break;
            case 'kel':
                return \App\Models\wilayah_kelurahan::find($id)->nama ?? "";
                break;
            default:
                # code...
                break;
        }
    }
}
