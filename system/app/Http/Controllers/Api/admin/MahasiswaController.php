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
    public function createdNoUjian($id)
    {
        try {
            $getNum = \Modules\V1\Entities\Pendaftaran::where("informasi_pendaftaran_id", $id)->where("status", "!=", "pending")->orderby('created_at', 'desc')->first();
            if (!empty($getNum)) {
                $getNums = explode("-", $getNum->no_resister);
                $noRegPad = 1;
                if (count($getNums) == 2) {
                    $inc = (int) $getNums[1];
                    $counter = $inc + 1;
                    $noRegPad = str_pad($counter, 4, '0', STR_PAD_LEFT);
                    $noreg = "on-" . $noRegPad;
                } else {
                    $noreg = "on-0001";
                }
            } else {
                $noreg = "on-0001";
            }
        } catch (\Throwable $th) {
            $noreg = "on-0001";
        }
        return $noreg;
    }
    public function verifikasi_pendaftaran(Request $request, $id)
    {
        try {
            $upMhs = \Modules\V1\Entities\Pendaftaran::find($id);

            $upMhs->status = $request->status;

            // add no ujian ==============
            $noUjian = $this->createdNoUjian($upMhs->informasi_pendaftaran_id);
            $upMhs->no_resister =  $noUjian;
            // ===========================

            $upMhs->save();
            $message = $request->message;
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
