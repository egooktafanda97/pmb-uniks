<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Control\ManagementCrud;

class Home extends Controller
{
    public $page = "website.page";
    public function index()
    {
        return view($this->page . ".home");
    }
    public function sign_up()
    {
        return view($this->page . ".sign_up");
    }
}
