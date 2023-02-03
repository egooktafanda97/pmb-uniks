<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
use App\Traits\ControllerTemplating;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\Auth;
/*
| USE COSTIM BY CONTROLLER
*/
use App\Clases\CalonMahasiswa;
use App\Traits\ManagementControlGetData;

/*
| END USE COSTIM BY CONTROLLER
*/

class CalonMhsController extends Controller
{
    use ManagementControlGetData;
    public $data;
    private $view = "admin.page.CalonMhs.";
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
        $data = new ManagementCrud("CalonMahasiswa");
        $pathJson =  config('generator_crud_config.scema_path');
        $data->instance($pathJson);
        $data->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->data = $data;
    }

    public function show(Request $request)
    {
        $data = ManagementControlGetData::result_query_dump_pmb($request);
        return view($this->view . 'mhs', $data);
    }
    public function details_data($id)
    {
        $prodi = \Modules\V1\Entities\Prodi::orderBy("id", "desc")->get();
        $pmb = \Modules\V1\Entities\Pendaftaran::whereId($id)->with([
            "users",
            "prodi",
            "informasi_pendaftaran",
            "calon_mahasiswa",
            "lampiran_pendaftaran",
            "bukti_pembayaran"
        ])->first();
        return [
            "prodi" => $prodi,
            "pendaftaran" => $pmb
        ];
    }
    public function getById($id)
    {
        $mhs = new CalonMahasiswa();
        $data = $this->details_data($id);
        $data["informasi_pendaftaran"] = $mhs->info_description($data);
        return view($this->view . 'detail', $data);
    }
}
