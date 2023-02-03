<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class InfoKhususController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
    }
    public function show()
    {
        $data["info"] = \Modules\V1\Entities\InfoKhusus::whereVisibility(true)
            ->where("to_user_id", auth()->user()->id)
            ->orWhere("visibility", "true")
            ->orderBy("created_at", "desc")
            ->get();
        return view("mahasiswa.page.InfoKhusus.index", $data);
    }
}
