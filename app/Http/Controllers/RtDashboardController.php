<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RtDashboardController extends Controller
{
    public function index()
    {
        return view('rt.index');
    }
}
