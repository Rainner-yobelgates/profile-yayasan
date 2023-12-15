<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Gallery;
use App\Models\Message;
use App\Models\Visitors;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard(){
        $active = 'dashboard';
        $countNews = News::count();
        $countGallery = Gallery::count();
        $countVisitor = Visitors::count();
        $getMessage = Message::orderBy('created_at', 'DESC')->limit(5)->get();
        $visitor = Visitors::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as visitor_count')
        )
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('visitor_count', 'month');
        return view('admin.dashboard', compact('active', 'getMessage', 'visitor', 'countNews', 'countGallery', 'countVisitor'));
    }
}
