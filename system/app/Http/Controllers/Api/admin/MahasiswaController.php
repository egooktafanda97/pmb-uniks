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
            $msg = 'data pendaftaran anda telah diperiksa pihak kampus';
            if ($message)
                $msg .= '<br> <strong>' . $message . '</strong>';
            $data = [
                "email" => $upMhs->users->email,
                'pesan' => $msg,
                'status' => $request->status
            ];
            dispatch(new \App\Jobs\SendEmailJob($data));
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
        $msg = 'dengan pertimbangan dari pihak kampus, atas nama ' . $upMhs->calon_mahasiswa->nama_lengkap . ' dinyatakan';
        $data = [
            "email" => $upMhs->users->email,
            'pesan' => $msg,
            'status' => $upMhs->status_seleksi
        ];
        dispatch(new \App\Jobs\SendEmailJob($data));
        return response()->json(true, 200);
        // } catch (\Throwable $th) {
        //     return response()->json(false, 401);
        // }
    }
}
