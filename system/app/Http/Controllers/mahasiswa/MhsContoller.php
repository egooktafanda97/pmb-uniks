<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class MhsContoller extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
    }
    public function register(Request $request)
    {
        $resources = new ManagementCrud(str_replace('Controller', '', "CalonMahasiswaController"));
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $resources->instance($pathJson);
        $resources->setNameSpaceModel("\Modules\V1\Entities\\");

        $Query = \Modules\V1\Entities\CalonMahasiswa::wherependaftaranId($request->pendaftaran_id)->with("orangtua")->first();
        // $__ortu = \Modules\V1\Entities\OrangTua::where("calon_mahasiswa_id", $Query->id)->first();

        if (empty($Query)) {
            /*
            | MANAGEMENT CONTROL CALON MAHASISWA
            */
            $calon_mhs =  $resources->generate_data_insert($request);
            /*
            | end
            */
            /*
            | MANAGEMENT CONTROL CALON ORANGTUA
            */
            if (!empty($calon_mhs['data']))
                $this->ortu($request->merge(["calon_mahasiswa_id" => $calon_mhs['data']['id']]));
            /*
            | end
            */
            return response()->json($calon_mhs, $calon_mhs["status"] ?? 400);
        } else {
            /*
            | UPDATE MANAGEMENT CONTROL CALON MAHASISWA
            */
            $calon_mhs_update =  $resources->generate_data_update($request, $Query->id);
            $id_ortu = !empty($Query->orangtua) ? $Query->orangtua->id : null;
            $this->ortu($request->merge(["calon_mahasiswa_id" => $Query->id]), $id_ortu);
            /*
            | end
            */
            return response()->json($calon_mhs_update, $calon_mhs_update["status"] ?? 400);
        }
    }
}
