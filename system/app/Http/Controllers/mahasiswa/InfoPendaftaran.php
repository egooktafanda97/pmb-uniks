<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class InfoPendaftaran extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
    }

    public function info()
    {
        $QR = \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->with("jadwal")->first();
        $data = [
            "queryes" => $QR,
            "sub_title"    => "Pendaftaran",
            "title" => "Tables",
        ];
        return view("mahasiswa.page.InfoPendaftaran.index", $data);
    }
}
