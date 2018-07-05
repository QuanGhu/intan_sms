<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PoliController extends Controller
{
    public function index()
    {
        return view('poli');
    }
}
