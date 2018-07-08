<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Yajra\Datatables\Datatables;
use Crud;

class AdminController extends Controller
{
    public function index()
    {
        $title = 'Daftar Admin';
        return view('admin')->with('title',$title);
    }

    public function save(Request $request, Admin $admin)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        $store = Crud::save($admin, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function list(Admin $admin)
    {

        $data = Crud::getAll($admin);
        return Datatables::of($data)->addColumn('action', function ($model) {
            return '
                <button type="button" class="btn btn-danger btn-cons btn-sm btn-small delete">Delete</button>
            ';
        })->addIndexColumn()->make(true);
    }

    public function delete(Request $request, Admin $admin)
    {
        $data = $request->id;
        $delete = Crud::delete($admin, 'id', $data);

        return $delete ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }
}
