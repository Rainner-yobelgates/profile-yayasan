<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'activity' => 'required',
            'description' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Kegiatan';
        $active = 'activity';
        return view('admin.activity.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Tambah Kegiatan';
        $viewType = 'create';
        $active = 'activity';
        return view('admin.activity.forms', compact('viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $data = $this->validate($request, $this->passingData);
        $getActivity = Activity::create($data);
        return redirect(route('admin.activity'))->with('success', 'Text Berjalan berhasil ditambah');
    }

    public function edit(Activity $activity){
        $title = 'Perbarui Kegiatan';
        $viewType = 'edit';
        $active = 'activity';
        return view('admin.activity.forms', compact('Activity', 'viewType', 'title', 'active'));
    }

    public function update(Activity $activity, Request $request){
        $data = $this->validate($request, $this->passingData);
        $activity->slug = null;
        $activity->update($data);
        return redirect(route('admin.activity'))->with('success', 'Text Berjalan berhasil diperbarui');
    }
    
    public function delete(Activity $activity){
        $activity->delete();
        return redirect(route('admin.activity'))->with('success', 'Text Berjalan Berhasil Dihapus');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Activity::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['activity', 'order', 'status', 'action'])
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="'.route('admin.activity.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 mr-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('admin.activity.delete', [$row->id]).'" method="POST">
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
