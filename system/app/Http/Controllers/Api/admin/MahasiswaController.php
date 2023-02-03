<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['']]);
    }
    public function verifikasi_pendaftaran(Request $request, $id)
    {
        try {
            $upMhs = \Modules\V1\Entities\Pendaftaran::find($id);
            $upMhs->status = $request->status;
            $message = $request->message;
            $upMhs->save();
            $msg = $request->msg;
            if ($message)
                $msg .= '<br> <strong>' . $message . '</strong>';

            $bgMsg = $request->bgMsg;
            $data = [
                "email" => $upMhs->users->email,
                'pesan' => $msg,
                'info' => '
                <a href=""
                    style="color:#fff;padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px; background:' . $bgMsg . ';">
                    <strong>' . $request->status . '</strong>
                </a>'
            ];
            \Modules\V1\Entities\InfoKhusus::create([
                "from_user_id" => auth()->user()->id,
                "to_user_id" => $upMhs->users->id,
                "subject" => "Info Validasi Data",
                "message" => $msg . "<br/> Data anda " . $request->status,
                "visibility" => true
            ]);
            if ($request->mail == 'true' || $request->mail == true)
                dispatch(new \App\Jobs\JobMessage($data));
            return response()->json(true, 200);
        } catch (\Throwable $th) {
            return response()->json(false, 401);
        }
    }
    public function status_seleksi(Request $request, $id)
    {
        // try {
        $upMhs = \Modules\V1\Entities\Pendaftaran::find($id);
        $upMhs->status_seleksi = $request->status_seleksi;
        $upMhs->save();
        $message = $request->message;
        $msg = 'dengan pertimbangan dari pihak kampus, atas nama ' . $upMhs->calon_mahasiswa->nama_lengkap . ' dinyatakan';
        $msg = 'data pendaftaran anda telah diperiksa pihak kampus.';
        if ($message)
            $msg .= '<br> <strong>' . $message . '</strong>';
        $data = [
            "email" => $upMhs->users->email,
            'pesan' => $msg,
            'info' => '
                <a href=""
                    style="color:#fff;padding-top:15px;padding-bottom:15px;padding-right:15px;padding-left:15px; background: #349eeb">
                    <strong>' . $request->status_seleksi . '</strong>
                </a>'
        ];
        $addInfoKhusus = \Modules\V1\Entities\InfoKhusus::create([
            "from_user_id" => auth()->user()->id,
            "to_user_id" => $upMhs->users->id,
            "subject" => "Info Validasi Data",
            "message" => $msg . "<br/> anda di nyatakan " . $request->status_seleksi,
            "visibility" => true
        ]);

        dispatch(new \App\Jobs\JobMessage($data));
        return response()->json(true, 200);
    }
}
