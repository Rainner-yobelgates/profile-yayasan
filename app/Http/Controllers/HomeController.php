<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Gallery;
use App\Models\News;
use App\Models\RunningText;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function home(){
        $title = "Beranda";
        $active = "home";
        $banner = Banner::where('status',1)->orderBy('order','ASC')->get();
        $bannerfirst = Banner::where('status',1)->orderBy('order','ASC')->first();
        $news = News::where('status',1)->orderBy('created_at','DESC')->paginate(8);
        $gallery = Gallery::where('status',1)->orderBy('created_at','DESC')->paginate(8);
        $runningtext = RunningText::where('status',1)->orderBy('order','ASC')->get();
        return view("user.home.index",compact('title','active','gallery','banner','bannerfirst','runningtext','news'));
    }
}
