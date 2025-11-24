<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Warga;
use App\Models\TrackingSurat; // ✅ tambahkan ini
use Illuminate\Http\Request;

class SuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = Surat::with(['warga'])->latest()->get();
        $warga = Warga::all();

        return view('admin.surat.index', compact('surat', 'warga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.surat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warga_id'    => 'required|exists:wargas,id',
            'jenis_surat' => 'required|string|max:255',
        ]);

        // Simpan surat baru
        $surat = new Surat();
        $surat->warga_id    = $request->warga_id;
        $surat->jenis_surat = $request->jenis_surat;
        $surat->status      = 'diajukan';
        $surat->save();

        // 🔥 Tambahkan otomatis ke tabel tracking_surat
        TrackingSurat::create([
            'surat_id'       => $surat->id,
            'status'         => 'diajukan',
            'tanggal_update' => now(),
        ]);

        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil ditambahkan dan otomatis tercatat di tracking.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Surat $surat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Surat $surat)
    {
        return view('admin.surat.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Surat $surat)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jenis_surat' => 'required|string|max:255',
        ]);

        $surat->warga_id = $request->warga_id;
        $surat->jenis_surat = $request->jenis_surat;
        $surat->save();

        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Surat $surat)
    {
        $surat->delete();
        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil dihapus.');
    }
}
