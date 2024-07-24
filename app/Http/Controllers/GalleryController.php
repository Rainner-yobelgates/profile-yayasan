<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'preview' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Galeri';
        $active = 'gallery';
        return view('admin.gallery.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Tambah Galeri';
        $viewType = 'create';
        $active = 'gallery';
        return view('admin.gallery.forms', compact('viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $this->passingData['image'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/gallery');
        }
        $getGallery = Gallery::create($data);
        return redirect(route('admin.gallery'))->with('success', 'Galeri berhasil ditambah');
    }

    public function edit(Gallery $gallery){
        $title = 'Perbarui Galeri';
        $viewType = 'edit';
        $active = 'gallery';
        return view('admin.gallery.forms', compact('gallery', 'viewType', 'title', 'active'));
    }

    public function update(Gallery $gallery, Request $request){
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('image')) {
            Storage::delete($gallery->image);
            $data['image'] = $request->file('image')->store('uploads/gallery');
        }
        
        $gallery->update($data);
        return redirect(route('admin.gallery'))->with('success', 'Galeri berhasil diperbarui');
    }
    
    public function delete(Gallery $gallery){
        $gallery->delete();
        return redirect(route('admin.gallery'))->with('success', 'Galeri Berhasil Dihapus');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Gallery::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['image', 'preview', 'order', 'status', 'action'])
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
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="'.route('admin.gallery.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 mr-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('admin.gallery.delete', [$row->id]).'" method="POST">
                            '.csrf_field().'
                            '.method_field ("delete").'
                            <button type="submit" onclick="return confirm(`Anda yakin ingin menghapusnya?`)" class="btn btn-danger mb-0">
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
