<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use Illuminate\Http\Request;

class IuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $iuran = Iuran::latest()->get();
        return view('admin.iuran.index', compact('iuran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.iuran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_iuran' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);
        $iuran = new Iuran();
        $iuran->nama_iuran = $request->nama_iuran;
        $iuran->deskripsi = $request->deskripsi;
        $iuran->harga = $request->harga;
        $iuran->save();

        return redirect()->route('admin.iuran.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(iuran $iuran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(iuran $iuran)
    {
        return view('admin.iuran.edit', compact('iuran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, iuran $iuran)
    {
        $request->validate([
            'nama_iuran' => 'required|string|max:255' . $iuran->id,
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric',
        ]);
        $iuran->nama_iuran = $request->nama_iuran;
        $iuran->deskripsi = $request->deskripsi;
        $iuran->harga = $request->harga;
        $iuran->save();

        return redirect()->route('admin.iuran.index')->with('success', 'Data Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(iuran $iuran)
    {
        $iuran->delete();
        return redirect()->route('admin.iuran.index')->with('success', 'Data Berhasil Dihapus');
    }
}
