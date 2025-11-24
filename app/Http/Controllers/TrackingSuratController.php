<?php

namespace App\Http\Controllers;

use App\Models\TrackingSurat;
use App\Models\Surat;
use App\Models\Warga;
use Illuminate\Http\Request;

class TrackingSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracking_surat = TrackingSurat::with(['surat.warga'])->latest()->get();
        $surat = Surat::select('id','warga_id','jenis_surat')->get();
        $warga = Warga::all();

        if (auth()->user()->role === 'rt') {
            return view('rt.tracking_surat.index', compact('tracking_surat', 'surat', 'warga'));
        }

        return view('admin.tracking_surat.index', compact('tracking_surat', 'surat', 'warga'));
    }

    public function create()
    {
        $warga = Warga::all();
        return view(auth()->user()->role === 'rt' 
            ? 'rt.tracking_surat.create' 
            : 'admin.tracking_surat.create', compact('warga','surat')
        );
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'surat_id' => 'required|exists:surats,id',
            'status' => 'required|string|max:255',
            'tanggal_update' => 'required|date',
        ]);

        // simpan tracking
        $tracking_surat = new TrackingSurat();
        $tracking_surat->surat_id = $request->surat_id;
        $tracking_surat->status = $request->status;
        $tracking_surat->tanggal_update = $request->tanggal_update;
        $tracking_surat->save();

        // update status surat
        $surat = Surat::find($request->surat_id);
        if ($surat) {
            $surat->status = $request->status;
            $surat->save();
        }

        $route = auth()->user()->role === 'rt'
            ? 'rt.tracking_surat.index'
            : 'admin.tracking_surat.index';

        return redirect()->route($route)->with('success', 'Tracking Surat Berhasil Ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrackingSurat $tracking_surat)
    {
        $warga = Warga::with('surat')->get();

        if (auth()->user()->role === 'rt') {
            return view('rt.tracking_surat.edit', compact('tracking_surat', 'warga'));
        }

        return view('admin.tracking_surat.edit', compact('tracking_surat', 'warga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrackingSurat $tracking_surat)
    {
        $request->validate([
            'surat_id' => 'required|exists:surats,id',
            'status' => 'required|string|max:255',
            'tanggal_update' => 'required|date',
        ]);

        $tracking_surat->surat_id = $request->surat_id;
        $tracking_surat->status = $request->status;
        $tracking_surat->tanggal_update = $request->tanggal_update;
        $tracking_surat->save();

        // update status surat
        $surat = Surat::find($request->surat_id);
        if ($surat) {
            $surat->status = $request->status;
            $surat->save();
        }

        $route = auth()->user()->role === 'rt'
            ? 'rt.tracking_surat.index'
            : 'admin.tracking_surat.index';

        return redirect()->route($route)->with('success', 'Tracking Surat Berhasil Diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrackingSurat $tracking_surat)
    {
        $tracking_surat->delete();

        $route = auth()->user()->role === 'rt'
            ? 'rt.tracking_surat.index'
            : 'admin.tracking_surat.index';

        return redirect()->route($route)->with('success', 'Tracking Surat Berhasil Dihapus.');
    }
}
