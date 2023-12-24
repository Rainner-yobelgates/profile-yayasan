<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\RunningText;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(){
        $title = "Beranda";
        $active = "home";
        $banner = Banner::where('status',1)->orderBy('order','ASC')->get();
        $runningtext = RunningText::where('status',1)->orderBy('order','ASC')->get();
        return view("user.home.index",compact('title','active','banner','runningtext'));
    }
}
