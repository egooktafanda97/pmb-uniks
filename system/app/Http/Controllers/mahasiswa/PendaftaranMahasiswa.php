<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


/*
| class costum crud management
*/
use App\Service\Control\ManagementCrud;
use App\Traits\ManagementRoler;
use App\Traits\ManagementControl;
use Modules\V1\Providers\ManagementServiceProvider;

use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Session;

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

class PendaftaranMahasiswa extends Controller
{
    use ManagementRoler;
    use ManagementControl;
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    public  $resources;

    public function __construct()
    {
        $resources = new ManagementCrud(str_replace('Controller', '', "PendaftaranController"));
        $pathJson =  ManagementServiceProvider::getScemaPath();
        $resources->instance($pathJson);
        $resources->setNameSpaceModel("\Modules\V1\Entities\\");
        $this->resources = $resources;

        /*
        | ManagementControl
        */
        $this->setSource($resources);
    }
    public function register(Request $request)
    {
        if (empty($this->resources))
            return redirect("/")->withErrors(['msg' => "Resource not found", "status" => 501]);
        $info_pendaftaran = \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->first();
        if (empty($info_pendaftaran))
            return redirect("/")->withErrors(['msg' => "Pendaftaran belum dibuka", "status" => 501]);
        $request->merge(["no_resister" => "UNIKS:" . \Str::random(4), "informasi_pendaftaran_id" => $info_pendaftaran->id]);
        $save =  $this->resources->generate_data_insert($request);
        if (!empty($save['status']) && $save['status'] == 200) {
            /*
            | AKTIFKAN JIKA AKAN MEMBUAT ROLE PADA USER
            */
            $this->create_role_users($save, 'mahasiswa');
            /*
            | end
            */
            $getUs = User::find($save['data']['user_id']);

            return redirect("/login");
        } else {
            return redirect("/")->withErrors(['msg' => $save, "status" => 201]);
        }
    }
}
