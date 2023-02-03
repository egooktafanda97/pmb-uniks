<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
use Illuminate\Support\Facades\Auth;

// uses traits 
use App\Traits\ManagementControlGetData;

class DashboardController extends Controller
{
    use ManagementControlGetData;
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
    }
    public function index()
    {
        $data = ManagementControlGetData::result_query_dump_data();
        // dd($data);
        return view("admin.page.Dashboard.dashboard", $data);
    }
}
