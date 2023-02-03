<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class ProdiController extends Controller
{

    public $data;
    private $view = "admin.page.Prodi.";
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
        $data = new ManagementCrud("Prodi");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->data = $data;
    }
    public function getData()
    {
        $prodi = \Modules\V1\Entities\Prodi::orderBy('id', 'desc')->paginate(10);
        return [
            "prodi" => $prodi,
            "sub_title"    => "Data Prodi",
            "title" => "Tables",
            "uri" => $this->data->getRouterWeb() ?? []
        ];
    }
    public function show()
    {
        $data =  $this->getData();
        return view($this->view . 'prodi', $data);
    }
    public function store()
    {
        $data = [
            "title" => "Input",
            "sub_title" => "Buat data program baru",
            "fakultas" => \Modules\V1\Entities\Fakultas::all(),
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'input', $data);
    }
    public function get_data_detail()
    {
    }
    public function detail($id)
    {
        $data = [
            "title" => "Detal",
            "sub_title" => "Detail Program Studi",
            "prodi" => \Modules\V1\Entities\Prodi::whereId($id)->first(),
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'detail', $data);
    }
}
