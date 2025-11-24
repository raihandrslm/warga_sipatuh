<?php

namespace App\Http\Controllers;

use App\Models\Bansos;
use Illuminate\Http\Request;

class BansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bansos = Bansos::latest()->get();
        return view('admin.bansos.index', compact('bansos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bansos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kriteria' => 'nullable|string',
        ]);

        Bansos::create($request->all());

        return redirect()->route('admin.bansos.index')->with('success', 'Bansos Berhasil Ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bansos $bansos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bansos $bansos)
    {
        return view('admin.bansos.edit', compact('bansos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bansos $bansos)
    {
        $validated = $request->validate([
            'nama_program' => 'required|string|max:255',
            'deskripsi'    => 'nullable|string',
            'kriteria'     => 'nullable|string',
        ]);

        $bansos->update($validated);

        return redirect()->route('admin.bansos.index')->with('success', 'Data bansos berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bansos $bansos)
    {
        $bansos->delete();
        return redirect()->route('admin.bansos.index')->with('success', 'Bansos Berhasil Dihapus.');
    }
}
