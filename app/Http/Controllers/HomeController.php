<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Gallery;
use App\Models\Message;
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

    function contact(){
        $title = "Hubungi Kami";
        $active = "contact";
        return view("user.contact.index",compact('title','active'));
    }
    
    function news(){
        $title = "Berita";
        $active = "news";
        $data = News::where('status',1)->orderBy('created_at','DESC')->get();
        return view("user.news.index",compact('title','active','data'));
    }
    function gallery(){
        $title = "Galeri";
        $active = "gallery";
        $data = Gallery::where('status',1)->orderBy('order','ASC')->get();
        return view("user.gallery.index",compact('title','active','data'));
    }
    function profile(){
        $title = "Profil Kami";
        $active = "profile";
        return view("user.about.profil",compact('title','active'));
    }

    function contactProcess(Request $request){
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'email' => 'required|email',
            'message' => 'required'
        ],[
            'name.required' => 'nama anda belum diisi',
            'name.regex' => 'nama mengandung karakter yang dilarang',
            'email.required' => 'email anda belum diisi',
            'email.email' => 'email tidak valid',
            'message.required' => 'pesan belum diisi',
        ]);
        
        Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success','Pesan telah dikirimkan, terimakasih.');
    }
}
