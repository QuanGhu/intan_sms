<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Yajra\Datatables\Datatables;
use Crud;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient');
    }

    public function list(Patient $patient)
    {

        $data = Crud::getAll($patient);
        return Datatables::of($data)
        ->editColumn('poli', function ($model) {
            return $model->poli->name;
        })->addIndexColumn()->make(true);
    }
}
