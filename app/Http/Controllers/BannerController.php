<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Spanduk';
        $active = 'banner';
        return view('admin.banner.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Tambah Spanduk';
        $viewType = 'create';
        $active = 'banner';
        return view('admin.banner.forms', compact('viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $this->passingData['image'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/banner');
        }
        $getBanner = Banner::create($data);
        return redirect(route('admin.banner'))->with('success', 'Galeri berhasil ditambah');
    }

    public function edit(Banner $banner){
        $title = 'Perbarui Spanduk';
        $viewType = 'edit';
        $active = 'banner';
        return view('admin.banner.forms', compact('banner', 'viewType', 'title', 'active'));
    }

    public function update(Banner $banner, Request $request){
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('image')) {
            Storage::delete($banner->image);
            $data['image'] = $request->file('image')->store('uploads/banner');
        }
        
        $banner->update($data);
        return redirect(route('admin.banner'))->with('success', 'Galeri berhasil diperbarui');
    }
    
    public function delete(Banner $banner){
        $banner->delete();
        return redirect(route('admin.banner'))->with('success', 'Galeri Berhasil Dihapus');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['image', 'order', 'status', 'action'])
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->editColumn('image', function ($row) {
                    $image = '<img src="'.asset("storage/". $row->image).'" class="img-fluid" style="width:75px;height:75px;object-fit: contain;" alt="Gambar">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center">
                        <a href="'.route('admin.banner.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 mr-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('admin.banner.delete', [$row->id]).'" method="POST">
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
