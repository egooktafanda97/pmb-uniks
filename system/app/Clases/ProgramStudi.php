<?php

namespace App\Clases;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProgramStudi
{
    public function info_description($data)
    {
        return [
            "prodi" => [
                "FAKULTAS",
                "NAMA ALIAS",
                "JENJANG",
                "AKREDITAS",
                "LATAR BELAKANG",

            ]
        ];
    }
}
