<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class RtDashboardController extends Controller
{
    public function index()
    {
        return view('rt.index', [
            'suratDiajukan' => Surat::where('status', 'diajukan')->count(),
            'suratDiproses' => Surat::where('status', 'diproses')->count(),
            'suratSelesai'  => Surat::where('status', 'selesai')->count(),
            'suratDitolak'  => Surat::where('status', 'ditolak')->count(),
        ]);
    }
}
