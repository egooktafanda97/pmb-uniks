<?php

namespace App\Http\Controllers\mahasiswa;

use App\Helpers\Helpers;
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
use Illuminate\Support\Facades\Crypt;
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

    protected $redirectTo = RouteServiceProvider::MHS;
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
    public function api_register(Request $request)
    {
        if (empty($this->resources))
            return response()->json([
                "error"  => "data not found",
                "status" => 501,
            ], 501);
        $info_pendaftaran = \Modules\V1\Entities\InformasiPendaftaran::whereStatus('active')->first();
        if (empty($info_pendaftaran))
            return response()->json([
                "error"  => "data not found",
                "status" => 501,
            ], 501);
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
            $getUs->nama = $request->email;
            $getUs->save();

            $getUs = User::find($save['data']['user_id']);
            $kode = "";
            do {
                $kode = Helpers::generatePin(4);
                $cek = \App\Models\Verify::where("key_reference", $kode)->first();
            } while (!empty($cek));

            $created_otp = \App\Models\Verify::create([
                "user_id" => $getUs->id,
                "key_reference" => $kode,
                "key_for" => "verifikai"
            ]);

            $details = [
                "email" => $getUs->email,
                "nama" => $getUs->nama,
                "kode" => $created_otp->key_reference
            ];
            dispatch(new \App\Jobs\SendEmailVerify($details));
            $enc = Crypt::encrypt($getUs->email);

            return response()->json([
                "result"  => $enc
            ], 200);
            // return redirect('auth/verify?s=' . $enc);
        } else {
            return response()->json($save, 401);
        }
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
            $getUs->nama = $request->email;
            $getUs->save();

            $getUs = User::find($save['data']['user_id']);
            $kode = "";
            do {
                $kode = Helpers::generatePin(4);
                $cek = \App\Models\Verify::where("key_reference", $kode)->first();
            } while (!empty($cek));

            $created_otp = \App\Models\Verify::create([
                "user_id" => $getUs->id,
                "key_reference" => $kode,
                "key_for" => "verifikai"
            ]);

            $details = [
                "email" => $getUs->email,
                "nama" => $getUs->nama,
                "kode" => $created_otp->key_reference
            ];
            dispatch(new \App\Jobs\SendEmailVerify($details));
            $enc = Crypt::encrypt($getUs->email);
            return redirect('auth/verify?s=' . $enc);
        } else {
            return redirect("/")->withErrors(['msg' => $save, "status" => 201]);
        }
    }
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 1000000000000
        ];
    }
}
