<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class Home extends Controller
{
    public $page = "website.page";

    public function getter_data()
    {
        $prodi = \Modules\V1\Entities\Prodi::orderBy("id", "desc")->get();
        $pmb = \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->first();
        return [
            "prodi" => $prodi,
            "pendaftaran" => $pmb
        ];
    }
    public function index()
    {
        $data = $this->getter_data();
        return view($this->page . ".home", $data);
    }
    public function sign_up()
    {
        return view($this->page . ".sign_up");
    }
}
