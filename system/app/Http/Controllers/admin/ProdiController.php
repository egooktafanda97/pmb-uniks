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
    public function update($id)
    {
        $d = \Modules\V1\Entities\Prodi::whereId($id)->with("users")->first();
        $data = [
            "title" => "Input",
            "sub_title" => "Program Studi",
            "prodi" => $d,
            "fakultas" => \Modules\V1\Entities\Fakultas::all(),
            "uri" => $this->data->getRouterWeb() ?? [],
        ];
        return view($this->view . 'input', $data);
    }
    public function detail($id)
    {
        $prod = \Modules\V1\Entities\Prodi::whereId($id)->with('fakultas')->first();
        $data = [
            "title" => "Detal",
            "sub_title" => "Detail Program Studi",
            "prodi" =>  $prod,
            "items" => \Modules\V1\Entities\Prodi::item_priodi($prod),
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'detail', $data);
    }
}
