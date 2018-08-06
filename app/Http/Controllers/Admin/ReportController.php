<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function dailyIndex()
    {
        $title = 'Laporan Harian';
        return view('daily')->with('title', $title);
    }

    public function monthlyIndex()
    {
        $title = 'Laporan Bulanan';
        return view('monthly')->with('title', $title);
    }
}
