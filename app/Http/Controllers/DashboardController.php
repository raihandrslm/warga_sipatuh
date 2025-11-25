<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Surat;
use App\Models\Iuran;
use App\Models\PenerimaBansos;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'jumlahWarga' => Warga::count(),
            'jumlahSurat' => Surat::count(),
            'jumlahIuran' => Iuran::count(),
            'jumlahBansos' => PenerimaBansos::count(),
        ]);
    }
}
