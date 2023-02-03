<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class PengumumanController extends Controller
{
    public $data;
    private $view = "admin.page.Pengumuman.";
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
        $data = new ManagementCrud("Pengumuman");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->data = $data;
    }
    public function getData()
    {
        $QR = \Modules\V1\Entities\Pengumuman::orderBy('created_at', 'DESC')->paginate(10);
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
    public function update($id)
    {
        $data = [
            "title" => "Input",
            "sub_title" => "Pengumuman",
            "fakultas" => \Modules\V1\Entities\Fakultas::all(),
            "uri" => $this->data->getRouterWeb() ?? [],
            "Quri" => \Modules\V1\Entities\Pengumuman::whereId($id)->first()
        ];
        return view($this->view . 'input', $data);
    }
    public function detail($id)
    {
        $QR = \Modules\V1\Entities\Pengumuman::whereId($id)->first();
        $data = [
            "queryes" => $QR,
            "sub_title"    => "Pendaftaran",
            "title" => "Tables",
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'detail', $data);
    }
}
