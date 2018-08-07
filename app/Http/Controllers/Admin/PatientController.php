<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Poli;
use Yajra\Datatables\Datatables;
use Crud;
use Carbon\Carbon;

class PatientController extends Controller
{
    public function index(Poli $poli)
    {
        $polies = $this->getAllPoli($poli);
        $title = 'Halaman Daftar Pasien';
        return view('patient')->with('title', $title)->with('polies',$polies);
    }

    public function list(Patient $patient)
    {

        $data = Crud::getAll($patient);
        return Datatables::of($data)
        ->editColumn('poli', function ($model) {
            return $model->poli->name;
        })->addIndexColumn()->make(true);
    }

    public function save(Request $request, Patient $patient)
    {
        $getLastQueue = Crud::base($patient)->whereYear('register_time', Carbon::now()->year)
            ->whereMonth('register_time', Carbon::now()->month)->where('poli_id', $request->poli_id)
            ->orderBy('id', 'desc')->first();
        $data = $request->all();
        $data['queue_code'] = '869844';
        $data['queue_no'] = $getLastQueue ? $getLastQueue->queue_no + 1 : '1';
        $data['register_time'] = Carbon::now();
        $store = Crud::save($patient, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function getAllPoli(Poli $poli)
    {
        return Poli::all()->pluck('name', 'id');
    }
}
