<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Model\Nav;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    public function __construct()
    {
        //导航菜单
        $nav = Nav::where('nav_status',0)->orderBy('nav_order','desc')->get();

        View::share('nav',$nav);
    }
}
