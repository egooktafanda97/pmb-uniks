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
        $this->middleware('is_verify_email')->except('login');
    }
    public function getter_data()
    {
        $prodi = \Modules\V1\Entities\Prodi::orderBy("id", "desc")->get();
        $pmb = \Modules\V1\Entities\Pendaftaran::whereUserId(Auth::user()->id)->with([
            "users",
            "prodi",
            "informasi_pendaftaran",
            "calon_mahasiswa",
            "lampiran_pendaftaran"
        ])->first();
        return [
            "prodi" => $prodi,
            "pendaftaran" => $pmb
        ];
    }
    public function index(Request $request)
    {
        $data = $this->getter_data();
        $c_mhs = $data["pendaftaran"]->calon_mahasiswa;
        $lampiran = $data["pendaftaran"]->lampiran_pendaftaran;
        $biaya_pendaftaran = $data["pendaftaran"]->bukti_pembayaran;
        $req = $request->edit ?? false;
        if (!$c_mhs || $c_mhs != null &&  $req == 'mhs')
            return view("mahasiswa.page.form_pendaftaran.form_pendaftaran", $data);
        else if (!$lampiran || $lampiran != null &&  $req == 'lampiran') {
            return view("mahasiswa.page.lampiran.index_lampiran", $data);
        } else if (!$biaya_pendaftaran || $biaya_pendaftaran != null &&  $req == 'biaya') {
            return view("mahasiswa.page.pembayaran.index_bukti", $data);
        } else {
            return view("mahasiswa.page.done.index");
        }
    }
}
