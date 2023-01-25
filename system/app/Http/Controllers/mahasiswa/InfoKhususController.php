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
        return view("mahasiswa.page.InfoKhusus.index");
    }
}
