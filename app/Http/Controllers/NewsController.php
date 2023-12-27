<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'thumbnail' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'title' => 'required',
            'content' => 'required',
            'created_by' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Berita';
        $active = 'news';
        return view('admin.news.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Tambah Berita';
        $viewType = 'create';
        $active = 'news';
        return view('admin.news.forms', compact('viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads/news');
        }
        $data['slug'] = Str::slug($data['title']);
        $getNews = News::create($data);
        return redirect(route('admin.news'))->with('success', 'Berita berhasil ditambah');
    }

    public function edit(News $news){
        $title = 'Perbarui Berita';
        $viewType = 'edit';
        $active = 'news';
        return view('admin.news.forms', compact('news', 'viewType', 'title', 'active'));
    }

    public function update(News $news, Request $request){
        $data = $this->validate($request, $this->passingData);
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('thumbnail')) {
            Storage::delete($news->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads/news');
        }
        $news->update($data);
        return redirect(route('admin.news'))->with('success', 'Berita berhasil diperbarui');
    }
    
    public function delete(News $news){
        $news->delete();
        return redirect(route('admin.news'))->with('success', 'Berita Berhasil Dihapus');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = News::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['thumbnail', 'title', 'content', 'created_by', 'order', 'status', 'action'])
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->editColumn('content', function ($row) {
                    return [
                        Str::limit($row->content,30),
                    ];
                })
                ->editColumn('thumbnail', function ($row) {
                    $image = '<img src="'.asset("storage/". $row->thumbnail).'" class="img-fluid" style="width:75px;height:75px;object-fit: contain;" alt="Gambar">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center">
                        <a href="'.route('admin.news.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 mr-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('admin.news.delete', [$row->id]).'" method="POST">
                            '.csrf_field().'
                            '.method_field ("delete").'
                            <button type="submit" class="btn btn-danger mb-0">
                            <i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    ';
                    return $btn;
                })
                ->make(true);
        }
    }
}
