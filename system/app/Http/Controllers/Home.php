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
        $pmb = \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->with("jadwal")->first();
        $pengumuman = \Modules\V1\Entities\Pengumuman::whereStatus('active')->first();
        return [
            "prodi" => $prodi,
            "pendaftaran" => $pmb,
            "pengumuman" => $pengumuman
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
    public function data_detail($id = null)
    {
        $prodi = \Modules\V1\Entities\Prodi::whereId($id)->orWhere('nama_prodi', 'like', '%' . $id . '%')->first();
        if (!$prodi) {
            abort(404);
        }
        return [
            "prodi" => $prodi
        ];
    }
    public function prodi()
    {
        $data = $this->getter_data();
        return view($this->page . ".list_prodi", $data);
    }
    public function detail_prodi($id = null)
    {
        $data = $this->data_detail($id);
        return view($this->page . ".prodi", $data);
    }
    public function info_pendaftaran()
    {
        $data = $this->getter_data();
        return view($this->page . ".info_pendaftaran", $data);
    }
}
