<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Poli;
use Yajra\Datatables\Datatables;
use Crud;

class PoliController extends Controller
{
    public function index()
    {
        return view('poli');
    }

    public function save(Request $request, Poli $poli)
    {
        $data = $request->all();
        $store = Crud::save($poli, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function list(Poli $poli)
    {

        $data = Crud::getAll($poli);
        return Datatables::of($data)->addColumn('action', function ($model) {
            return '
                <button type="button" class="btn btn-info btn-cons btn-sm btn-small edit">Update</button>
                <button type="button" class="btn btn-danger btn-cons btn-sm btn-small delete">Delete</button>
            ';
        })->addIndexColumn()->make(true);
    }

    public function delete(Request $request, Poli $poli)
    {
        $data = $request->id;
        $delete = Crud::delete($poli, 'id', $data);

        return $delete ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function update(Request $request, Poli $poli)
    {
        $data = $request->all();
        unset($data['_token']);
        $store = Crud::update($poli, 'id', $request->id, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }
}
