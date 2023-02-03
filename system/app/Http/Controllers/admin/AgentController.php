<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class AgentController extends Controller
{
    public $data;
    private $view = "admin.page.Agent.";
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
        $data = new ManagementCrud("Agent");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->data = $data;
    }

    public function getData()
    {
        $agent = \Modules\V1\Entities\Agent::orderBy('id', 'desc')->paginate(10);
        return [
            "agent" => $agent,
            "sub_title"    => "Data Agent",
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
            "fakultas" => \Modules\V1\Entities\Agent::all(),
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'input', $data);
    }
    public function update($id)
    {
        $data = [
            "title" => "Input",
            "sub_title" => "Pengumuman",
            "fakultas" => \Modules\V1\Entities\Agent::all(),
            "uri" => $this->data->getRouterWeb() ?? [],
        ];
        return view($this->view . 'input', $data);
    }
    public function detail($id)
    {
        $QR = \Modules\V1\Entities\Agent::whereId($id)->first();
        $data = [
            "queryes" => $QR,
            "sub_title"    => "Pendaftaran",
            "title" => "Tables",
            "uri" => $this->data->getRouterWeb() ?? []
        ];
        return view($this->view . 'detail', $data);
    }
}
