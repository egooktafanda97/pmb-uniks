<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
    }
    public function getter_data()
    {
        $prodi = \Modules\V1\Entities\Prodi::orderBy("id", "desc")->get();
        $pmb = \Modules\V1\Entities\Pendaftaran::whereUserId(Auth::user()->id)->with([
            "users",
            "prodi",
            "informasi_pendaftaran",
            "calon_mahasiswa"
        ])->first();
        return [
            "prodi" => $prodi,
            "pendaftaran" => $pmb
        ];
    }
    public function index(Request $request)
    {
        $data = $this->getter_data();
        if (!$data["pendaftaran"]->calon_mahasiswa || !empty($data["pendaftaran"]->calon_mahasiswa) && !empty($request->edit) && $request->edit == 'mhs')
            return view("mahasiswa.page.form_pendaftaran.form_pendaftaran", $data);
        else {
            return view("mahasiswa.page.done.index");
            // return view("mahasiswa.page.pembayaran.index_bukti", $data);
        }
    }
}
