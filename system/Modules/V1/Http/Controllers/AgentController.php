<?php

namespace Modules\V1\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
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
/*
| end
*/

class AgentController extends Controller
{
    use ManagementRoler;
    use ManagementControl;


    public  $resources;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['']]);
        $resources = new ManagementCrud(str_replace('Controller', '', "AgentController"));
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
            try {
                // /*
                // | AKTIFKAN JIKA AKAN MEMBUAT ROLE PADA USER
                // */
                if (!$roler = $this->newRole("api", 'agent'))
                    return ["error" => "role instansi could not be created"];
                $m = \App\Models\User::find($save['data']['user_id']);
                $this->createRole($m, $roler);
                try {
                    $data = [
                        "email" => $m->email,
                        'pesan' => "Anda telah di daftarkan sebagai agent penerimaan mahasiswa baru, 
                                <br>
                                <div><strong>Password : " . $request->password . "</strong></div>
                                <div><strong>Referal  : " . $request->referal . "</strong></div>
                                <p>Berikan kode referal anda kepada calon mahasiswa baru.</p>",
                    ];
                    dispatch(new \App\Jobs\JobMessage($data));
                } catch (\Throwable $th) {
                }
                // /*
                // | end
                // */
                return response()->json($save, 200);
            } catch (\Throwable $th) {
                return response()->json(["error" => $th->getMessage()], 501);
            }
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
    public function generate_referal($nums)
    {
        $referal = \Modules\V1\Entities\Agent::orderBy("id", "DESC")->first();
        if (!empty($referal)) {
            $x = explode("-", $referal->referal);
            $y =  (int)$x[1] + 1;
            $res = "AG-" . str_pad($y, 3, '0', STR_PAD_LEFT);
        } else {
            $res = "AG-0001";
        }
        return response()->json($res);
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
}
