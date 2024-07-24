<?php

namespace App\Http\Controllers;

use App\Models\RunningText;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RunningTextController extends Controller
{
    protected $passingData;
    public function __construct()
    {
        $this->passingData = [
            'sentence' => 'required',
            'order' => 'required|numeric',
            'status' => 'required|numeric',
        ];
    }

    public function index(){
        $title = 'Data Tulisan Berjalan';
        $active = 'running-text';
        return view('admin.running-text.index', compact('title', 'active'));
    }

    public function create(){
        $title = 'Tambah Tulisan Berjalan';
        $viewType = 'create';
        $active = 'running-text';
        return view('admin.running-text.forms', compact('viewType', 'title', 'active'));
    }

    public function store(Request $request){
        $data = $this->validate($request, $this->passingData);
        $getRunningText = RunningText::create($data);
        return redirect(route('admin.running-text'))->with('success', 'Text Berjalan berhasil ditambah');
    }

    public function edit(RunningText $runningText){
        $title = 'Perbarui Tulisan Berjalan';
        $viewType = 'edit';
        $active = 'running-text';
        return view('admin.running-text.forms', compact('runningText', 'viewType', 'title', 'active'));
    }

    public function update(RunningText $runningText, Request $request){
        $data = $this->validate($request, $this->passingData);
        $runningText->update($data);
        return redirect(route('admin.running-text'))->with('success', 'Text Berjalan berhasil diperbarui');
    }
    
    public function delete(RunningText $runningText){
        $runningText->delete();
        return redirect(route('admin.running-text'))->with('success', 'Text Berjalan Berhasil Dihapus');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = RunningText::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['sentence', 'order', 'status', 'action'])
                ->editColumn('status', function ($row) {
                    return [
                        get_list_status()[$row->status],
                    ];
                })
                ->editColumn('sentence', function ($row) {
                    return [
                        Str::limit($row->sentence,30),
                    ];
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="'.route('admin.running-text.edit',[$row->id]).'" class="btn btn-primary btn-edit mb-0 mr-2"><i class="fas fa-edit"></i></a>
                        <form action="'.route('admin.running-text.delete', [$row->id]).'" method="POST">
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
