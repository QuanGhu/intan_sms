<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use Crud;

class ReportController extends Controller
{
    public function dailyIndex()
    {
        $title = 'Laporan Harian';
        return view('daily')->with('title', $title);
    }

    public function getDailyReport(Request $request, Patient $patient)
    {
        $datestart = $request->datestart;
        $datestop = $request->datestop;
        $data = Crud::base($patient)->whereBetween('register_time', [$datestart." 00:00:00",$datestop." 23:59:59"])->get();
        
        return $request->ajax() ? view('ajax.daily')->with(['patients' => $data])->render()
            : view('ajax.daily')->with(['patients' => $data]);
    }

    public function monthlyIndex()
    {
        $title = 'Laporan Bulanan';
        return view('monthly')->with('title', $title);
    }

    public function getMonthlyReport(Request $request, Patient $patient)
    {
        $data = Crud::base($patient)->whereYear('register_time', $request->year)
                ->whereMonth('register_time', $request->month)->get();
        
        return $request->ajax() ? view('ajax.monthly')->with(['patients' => $data])->render()
            : view('ajax.monthly')->with(['patients' => $data]);
    }
}
