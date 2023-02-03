<?php

namespace App\Http\Controllers\Api\PublicApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// uses 
use App\Traits\ManagementControlGetData;

class DataPublicController extends Controller
{
    use ManagementControlGetData;

    public function getReportCMhs(Request $request)
    {
        $get = ManagementControlGetData::result_query_dump_pmb($request, false);
        return response()->json($get);
    }
}
