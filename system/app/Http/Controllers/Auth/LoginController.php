<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Laravel\Socialite\Facades\Socialite; //tambahkan library socialite
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        // $this->middleware('auth:web', ['except' => ['login']]);
        // $this->middleware('guest', ['except' => ['login']]);
    }

    protected function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect("/login")->withErrors(['msg' => "username & password tidak valid", "status" => 501]);
        }

        if (!auth()->guard("web")->attempt($validator->validated())) {
            return redirect("/login")->withErrors(['msg' => 'username or password found', "status" => 501]);
        }

        if (!$token = auth()->guard("api")->attempt($validator->validated())) {
            return redirect("/login")->withErrors(['msg' => 'username or password found', "status" => 201]);
        }

        $genTokenApi = $this->respondWithToken($token);
        \Session::put('token', $genTokenApi);

        if (Auth::user()->hasRole('mahasiswa')) {
            $Query = \Modules\V1\Entities\Pendaftaran::whereuserId(Auth::user()->id)->with("calon_mahasiswa")->first();
            if ($Query->calon_mahasiswa == null) {
                return redirect('/mahasiswa/form');
            } else {
                return redirect('/mahasiswa/profile');
            }
        } else if (Auth::user()->hasRole('admin')) {
            return redirect($this->redirectPath());
        }
    }
    protected function register($google = null)
    {
        $data = [];
        if (!empty($google) && $google != null) {
            $data = [
                "nama" =>  $google->getName(),
                "email" =>  $google->getEmail(),
            ];
        }
        return view("auth.register", $data);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
    public function controlLogout()
    {
        Auth::logout();
    }
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 1000000000000
        ];
    }


    //tambahkan script di bawah ini
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }


    //tambahkan script di bawah ini 
    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();


            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if ($user != null) {
                Auth::login($user);
                if (!$token = auth()->guard("api")->login($user)) {
                    return view("auth.verifikasi");
                }
                $genTokenApi = $this->respondWithToken($token);
                Session::put('token', $genTokenApi);
                $Query = \Modules\V1\Entities\Pendaftaran::whereuserId(Auth::user()->id)->with("calon_mahasiswa")->first();
                if ($Query->calon_mahasiswa == null) {
                    return redirect('/mahasiswa/form');
                } else {
                    return redirect('/mahasiswa/profile');
                }
            } else {
                do {
                    $digits = 4;
                    $kode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                    $cek = \App\Models\Verify::where("key_reference", $kode)->first();
                } while (!empty($cek));
                return $this->register($user_google);
                // $create = User::Create([
                //     'email'             => $user_google->getEmail(),
                //     'name'              => $user_google->getName(),
                //     'password'          => 0,
                //     'email_verified_at' => now()
                // ]);

                // return redirect()->route('login');
            }
        } catch (\Exception $e) {
            dd($e);
            // return redirect()->route('login');
        }
    }
    public function otp(Request $request)
    {
        $data = $request->otp;
        $cek = \App\Models\Verify::where("key_reference", $data)->first();
        if ($cek)
            return response()->json(Crypt::encrypt($cek->key_reference), 200);
        else
            return response()->json([], 401);
    }
    public function verify($otp = null)
    {
        if (!$otp)
            return view("auth.verifyPage");
        try {
            $x_otp  = Crypt::decrypt($otp);
            $user = User::whereHas('verify', function ($q) use ($x_otp) {
                $q->where('key_reference', $x_otp);
            })->first();

            if (!$user) {
                return view("auth.verifyPage");
            } else {
                // created email verification
                $us = User::find($user->id);
                $us->email_verified_at =  now();
                $us->save();

                Auth::login($user);

                if (!$token = auth()->guard("api")->login($user)) {
                    return view("auth.verifikasi");
                }
                $genTokenApi = $this->respondWithToken($token);
                Session::put('token', $genTokenApi);
                $user->verify()->delete();

                $Query = \Modules\V1\Entities\Pendaftaran::whereuserId(Auth::user()->id)->with("calon_mahasiswa")->first();
                if ($Query->calon_mahasiswa == null) {
                    return redirect('/mahasiswa/form');
                } else {
                    return redirect('/mahasiswa/profile');
                }
            }
        } catch (\Throwable $th) {
            return response()->json(false, 401);
        }
    }
    public function resending_email(Request $request)
    {
        // try {
        $req = $request->email;
        $user = User::where("email", $request->oldEmail)->first();
        $validator = Validator::make($request->all(), [
            'email' =>  'unique:users,email,' . $user->id
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user->email = $req;
        $up = $user->save();

        if (empty($user->verify)) {
            $kode = "";
            do {
                $digits = 4;
                $kode = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
                $cek = \App\Models\Verify::where("key_reference", $kode)->first();
            } while (!empty($cek));
            $created_otp = \App\Models\Verify::create([
                "user_id" => $user->id,
                "key_reference" => $kode,
                "key_for" => "verifikai"
            ]);
        }
        if ($up) {
            $details = [
                "email" => $user->email,
                "nama" => $user->nama,
                "kode" => $user->verify->key_reference ?? $kode
            ];
            dispatch(new \App\Jobs\SendEmailVerify($details));
        }
        return response()->json(true, 200);
        // } catch (\Throwable $th) {
        //     return response()->json(["error" => "server error, try again!"], 401);
        // }
    }
    public function reset_password()
    {
        return view("auth.resetpwd");
    }
    public function email_check(Request $request)
    {
        $user = User::where("email", $request->email)->first();
        if ($user) {
            //Create Password Reset Token
            \DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => \Str::random(60),
                'created_at' => Carbon::now()
            ]);
            //Get the token just created above
            $tokenData = \DB::table('password_resets')
                ->where('email', $request->email)->first();
            $details = [
                "email" => $user->email,
                "nama" => $user->nama,
                "token" => $tokenData->token
            ];
            dispatch(new \App\Jobs\SendEmailReset($details));

            return response()->json(["token" => $tokenData->token], 200);
        } else {
            return response()->json(false, 401);
        }
    }
    public function resets()
    {
        return view("auth.resets");
    }
    public function reset_confirm(Request $request)
    {
        $token = $request->token;
        if (!$token)
            return view('error.404');
        $checks = \App\Models\PasswordResets::whereToken($token)->first();
        if (!$checks)
            return view('error.404');
        $users = \App\Models\User::whereEmail($checks->email)->first();
        if (!$users)
            return view('error.404');
        $users->password =  bcrypt($request->password);
        $us = $users->save();
        if (!$us)
            return view('error.401');
        $details = [
            "email" => $users->email,
            "pesan" => "password anda berhasil diubah."
        ];
        dispatch(new \App\Jobs\JobMessage($details));
        return redirect("/login");
    }
}
