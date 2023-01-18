<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
use App\Traits\ControllerTemplating;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Auth;

class FakultasController extends Controller
{
    public $data;
    private $view = "admin.page.Fakultas.";
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
        $data = new ManagementCrud("Fakultas");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->data = $data;
    }
    public function getData()
    {
        $fakultas = \Modules\V1\Entities\Fakultas::orderBy('id', 'desc')->paginate(10);
        return [
            "fakultas" => $fakultas,
            "sub_title"    => "Data Fakultas",
            "title" => "Tables",
            "uri" => $this->data->getRouterWeb() ?? []
        ];
    }
    public function show()
    {
        $data =  $this->getData();
        return view($this->view . 'fakultas', $data);
    }
    public function store(Request $request)
    {
        $data = [
            "title" => "Input",
            "sub_title" => "Buat data fakultas baru",
            "uri" => $this->data->getRouterWeb() ?? []
        ];

        return view($this->view . 'input', $data);
    }
}
