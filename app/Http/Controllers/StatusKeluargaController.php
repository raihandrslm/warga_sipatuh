<?php

namespace App\Http\Controllers;

use App\Models\StatusKeluarga;
use Illuminate\Http\Request;

class StatusKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status_keluarga = StatusKeluarga::latest()->get();
        return view('admin.status_keluarga.index', compact('status_keluarga'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.status_keluarga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'klasifikasi' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
        ]);
        $status_keluarga       = new StatusKeluarga();
        $status_keluarga->klasifikasi = $request->klasifikasi;
        $status_keluarga->deskripsi = $request->deskripsi;
        $status_keluarga->save();

        return redirect()->route('admin.status_keluarga.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(StatusKeluarga $status_keluarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StatusKeluarga $status_keluarga)
    {
        return view('admin.status_keluarga.edit', compact('status_keluarga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StatusKeluarga $status_keluarga)
    {
        $request->validate([
            'klasifikasi' => 'required|string|max:255' . $status_keluarga->id,
            'deskripsi' => 'required|string|max:255' . $status_keluarga->id,
        ]);
        $status_keluarga->klasifikasi = $request->klasifikasi;
        $status_keluarga->deskripsi = $request->deskripsi;
        $status_keluarga->save();

        return redirect()->route('admin.status_keluarga.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StatusKeluarga $status_keluarga)
    {
        $status_keluarga->delete();
        return redirect()->route('admin.status_keluarga.index')->with('success','Data Telah Berhasil Dihapus');
    }
}
