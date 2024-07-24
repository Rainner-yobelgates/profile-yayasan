<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class InstitutionController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'logo' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'name' => 'required',
            'description' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Lembaga';
        $active = 'institution';
        return view('admin.institution.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Tambah Lembaga';
        $viewType = 'create';
        $active = 'institution';
        return view('admin.institution.forms', compact('viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $this->passingData['logo'] = 'required|image|mimes:jpeg,png,jpg,webp|max:2048';
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('uploads/institution');
        }
        $getInstitution = Institution::create($data);
        return redirect(route('admin.institution'))->with('success', 'Lembaga berhasil ditambah');
    }

    public function edit(Institution $institution){
        $title = 'Perbarui Lembaga';
        $viewType = 'edit';
        $active = 'institution';
        return view('admin.institution.forms', compact('institution', 'viewType', 'title', 'active'));
    }

    public function update(Institution $institution, Request $request){
        $data = $this->validate($request, $this->passingData);
        if ($request->hasFile('logo')) {
            Storage::delete($institution->logo);
            $data['logo'] = $request->file('logo')->store('uploads/institution');
        }
        $institution->slug = null;
        $institution->update($data);
        return redirect(route('admin.institution'))->with('success', 'Lembaga berhasil diperbarui');
    }
    
    public function delete(Institution $institution){
        $institution->delete();
        return redirect(route('admin.institution'))->with('success', 'Lembaga Berhasil Dihapus');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Institution::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['logo', 'name', 'description', 'order', 'status', 'action'])
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->editColumn('logo', function ($row) {
                    $image = '<img src="'.asset("storage/". $row->logo).'" class="img-fluid" style="width:75px;height:75px;object-fit: contain;" alt="Gambar">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="'.route('admin.institution.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 mr-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('admin.institution.delete', [$row->id]).'" method="POST">
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
