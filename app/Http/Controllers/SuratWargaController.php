<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\TrackingSurat;
use Illuminate\Support\Facades\Auth;

class SuratWargaController extends Controller
{
    /**
     * Halaman daftar surat milik warga yang login
     */
    public function index()
    {
        $warga = Auth::guard('warga')->user();

        $suratWarga = Surat::where('warga_id', $warga->id)
            ->with('tracking_surat')
            ->latest()
            ->get();

        return view('warga.surat.index', compact('suratWarga'));
    }

    /**
     * Warga mengajukan surat dari modal di dashboard
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required|string',
        ]);

        $warga = Auth::guard('warga')->user();

        // Simpan surat
        $surat = Surat::create([
            'warga_id'    => $warga->id,
            'jenis_surat' => $request->jenis_surat,
            'status'      => 'diajukan',
        ]);

        // Catat otomatis tracking
        TrackingSurat::create([
            'surat_id'       => $surat->id,
            'status'         => 'diajukan',
            'tanggal_update' => now(),
        ]);

        return back()->with('success', 'Surat berhasil diajukan.');
    }

    /**
     * Tidak dipakai warga → kosongkan
     */
    public function create() {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}

    /**
     * Hapus surat (opsional)
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->warga_id != Auth::guard('warga')->id()) {
            return back()->with('error', 'Tidak memiliki izin.');
        }

        $surat->delete();

        return back()->with('success', 'Surat berhasil dihapus.');
    }
}
