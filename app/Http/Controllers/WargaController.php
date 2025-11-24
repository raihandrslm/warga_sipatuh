<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\StatusKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warga = Warga::with('status_keluarga')->latest()->get();
        $status_keluarga = StatusKeluarga::all();

        return view('admin.warga.index', compact('warga', 'status_keluarga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status_keluarga = StatusKeluarga::all();
        return view('admin.warga.create', compact('status_keluarga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:wargas,nik',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'status_keluarga_id' => 'required|exists:status_keluargas,id',
        ]);

        Warga::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'status_keluarga_id' => $request->status_keluarga_id,
        ]);

        return redirect()->route('admin.warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warga $warga)
    {
        $status_keluarga = StatusKeluarga::all();
        return view('admin.warga.edit', compact('warga', 'status_keluarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:wargas,nik,' . $warga->id,
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'status_keluarga_id' => 'required|exists:status_keluargas,id',
        ]);

        // Ambil semua data yang bisa diupdate
        $data = [
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'status_keluarga_id' => $request->status_keluarga_id,
        ];
        $warga->update($data);

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();

        return redirect()->route('admin.warga.index')->with('success', 'Data warga berhasil dihapus.');
    }
}
