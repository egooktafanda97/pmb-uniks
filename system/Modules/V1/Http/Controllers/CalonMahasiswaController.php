<?php

namespace Modules\V1\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/*
| class costum crud management
*/
use App\Service\Control\ManagementCrud;
use App\Traits\ManagementRoler;
use App\Traits\ManagementControl;
use Modules\V1\Providers\ManagementServiceProvider;
/*
| end
*/

/*
| USE MODEL
*/
// use App\Models\User;
use App\Traits\ManagementControlGetData;
use App\Service\Control\Template;
/*
| end
*/

class CalonMahasiswaController extends Controller
{
    use ManagementRoler;
    use ManagementControl;
    use ManagementControlGetData;


    public  $resources;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['']]);
        $resources = new ManagementCrud(str_replace('Controller', '', "CalonMahasiswaController"));
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $resources->instance($pathJson);
        $resources->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->resources = $resources;

        /*
        | ManagementControl
        */
        $this->setSource($resources);
        /*
        | end
        */
    }

    /**
     * .
     * function insert
     * @return void
     */
    public function store(Request $request)
    {
        if (empty($this->resources))
            return response()->json(["error" => "resource not found"],  501);
        $save =  $this->resources->generate_data_insert($request);
        if (!empty($save['status']) && $save['status'] == 200) {
            /*
            | AKTIFKAN JIKA AKAN MEMBUAT ROLE PADA USER
            */
            // $this->create_role_users($save);
            /*
            | end
            */
            return response()->json($save, $save['status'] ?? 401);
        } else {
            return response()->json($save, $save['status'] ?? 401);
        }
    }

    /**
     * .
     * FUNCTION UPDATE DATA
     * @return void
     */
    public function update(Request $request, $id)
    {
        if (empty($this->resources))
            return response()->json(["error" => "resource not found"],  501);
        $request->merge([
            "code_reference" => Str::random(40),
            "role" => "instansi",
        ]);
        $save =  $this->resources->generate_data_update($request, $id);
        return response()->json($save, $save['status'] ?? 401);
    }

    /**
     * .
     * FUNCTION DELETE DATA
     * @return void
     */
    public function delete($id)
    {
        if (empty($this->resources))
            return response()->json(["error" => "resource not found"],  501);
        $hndelAction = $this->resources->deleted($id);
        return response()->json($hndelAction, $hndelAction['status'] ?? 401);
    }
    /**
     * .
     * FUNCTION GET DATA TO CHART
     * @return void
     */
    public function chart(Request $request)
    {
        $get = ManagementControlGetData::result_query_dump_pmb($request, false);
        $pendaftaran_group = [
            "id" => "pendafataran",
            "label" => ManagementControl::map_fead($get['mhs']->groupBy("pendaftaran.informasi_pendaftaran.Combine"), function ($key, $val, $i) {
                return $key;
            }),
            "map_data" => ManagementControl::map_fead($get['mhs']->groupBy("pendaftaran.informasi_pendaftaran.Combine"), function ($keys, $val, $i) {
                $main = $val;
                $result_data_status = $val->groupBy("pendaftaran.status");
                return [
                    "labels" => $keys,
                    "data" => $main,
                    "by_status" => [
                        "pending" =>  $result_data_status['pending'] ?? [],
                        "valid" => $result_data_status['valid'] ?? [],
                        "invalid" =>  $result_data_status['invalid'] ?? []
                    ],
                    "count" => count($val),
                    "color" => Template::gradientAssetColor()[$i]
                ];
            })
        ];
        $prodi_group = [];

        // $chart_by_status = [
        //     "id" => "chart_by_status",
        //     "label" => ManagementControl::map_fead($get['mhs']->groupBy("pendaftaran.status"), function ($key, $val, $i) {
        //         return $key;
        //     }),
        //     "map_data" => ManagementControl::map_fead($get['mhs']->groupBy("pendaftaran.status"), function ($key, $val, $i) {
        //         return [
        //             "labels" => $key,
        //             "data" => $val,
        //             "count" => count($val),
        //             "color" => Template::gradientAssetColor()[$i]
        //         ];
        //     })
        // ];
        return response()->json([
            "jumlah_data" => $get['mhs']->count(),
            "maping_data" => ["pendaftaran" => $pendaftaran_group]
        ]);
    }
}
