<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
// uses traits 
use App\Traits\ManagementControlGetData;

class DashboardController extends Controller
{
    use ManagementControlGetData;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['dashboard_data']]);
    }
    public function dashboard_data()
    {
        $data = ManagementControlGetData::result_query_dump_data();
        return response()->json($data);
    }
}
