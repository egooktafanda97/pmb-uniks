<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => []]);
    }
    public function index()
    {
        return view("admin.page.Dashboard.dashboard");
    }
}
