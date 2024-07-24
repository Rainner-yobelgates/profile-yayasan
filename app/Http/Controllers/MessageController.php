<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(){
        $title = 'Data Pesan';
        $active = 'message';
        return view('admin.message.index', compact('title', 'active'));
    }

    public function show(Message $message){
        $title = 'Menampilkan Pesan';
        $viewType = 'show';
        $active = 'message';
        return view('admin.message.forms', compact('message', 'viewType', 'title', 'active'));
    }
    
    public function delete(Message $message){
        $message->delete();
        return redirect(route('admin.message'))->with('success', 'Pesan Berhasil Dihapus');
    }

    public function data(Request $request)
    {
        if ($request->ajax()) {
            $data = Message::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                ->addIndexColumn()                
                ->rawColumns(['name', 'email', 'message', 'action'])
                ->editColumn('message', function ($row) {
                    return [
                        Str::limit($row->message,30),
                    ];
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="'.route('admin.message.show',[$row->id]).'" class="btn btn-info btn-edit mb-0 mr-2"><i class="fas fa-eye"></i></a>
                        <form action="'.route('admin.message.delete', [$row->id]).'" method="POST">
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
