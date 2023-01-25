<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class InformasiPendaftaran extends Controller
{
    public $data;
    private $view = "admin.page.InformasiPendaftaran.";
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
        $data = new ManagementCrud("InformasiPendaftaran");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->data = $data;
    }
    public function getData()
    {
        $QR = \Modules\V1\Entities\InformasiPendaftaran::orderBy('id', 'desc')->paginate(10);
        return [
            "data" => $QR,
            "sub_title"    => "Pendaftaran",
            "title" => "Tables",
            "uri" => $this->data->getRouterWeb() ?? []
        ];
    }
    public function show()
    {
        $data =  $this->getData();
        return view($this->view . 'index', $data);
    }
    public function store()
    {
        $data = [
            "title" => "Input",
            "sub_title" => "Buat Pendaftran Baru",
            "fakultas" => \Modules\V1\Entities\Fakultas::all(),
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'input', $data);
    }
    public function detail($id)
    {
        $QR = \Modules\V1\Entities\InformasiPendaftaran::whereId($id)->with("jadwal")->first();
        $data = [
            "queryes" => $QR,
            "sub_title"    => "Pendaftaran",
            "title" => "Tables",
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'detail', $data);
    }
}
