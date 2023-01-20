<?php

namespace App\Http\Controllers\mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class MhsContoller extends Controller
{
    public function store(Request $request)
    {
        dd($request->all());
    }
}
