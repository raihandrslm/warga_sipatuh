<?php

namespace App\Http\Controllers;

use App\Models\PenerimaBansos;
use App\Models\Warga;
use App\Models\Bansos;
use App\Models\SurveyStatus;
use Illuminate\Http\Request;

class PenerimaBansosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penerima_bansos = PenerimaBansos::with(['warga.surveyStatus', 'bansos'])->latest()->get();
        $warga   = Warga::all();
        $bansos  = Bansos::all();

        return view('admin.penerima_bansos.index', compact('penerima_bansos','warga','bansos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penerima_bansos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'warga_id'       => 'required|exists:wargas,id',
            'bansos_id'      => 'required|exists:bansos,id',
            'tanggal_terima' => 'required|date',
        ]);

        $warga = Warga::with('status_keluarga')->findOrFail($request->warga_id);

        if ($warga->status_keluarga && strtolower($warga->status_keluarga->klasifikasi) === 'kurang mampu') {
            PenerimaBansos::create([
                'warga_id'       => $request->warga_id,
                'bansos_id'      => $request->bansos_id,
                'tanggal_terima' => $request->tanggal_terima,
                'status'         => 'diterima',
            ]);

            return redirect()->back()->with('success', 'Warga Berhasil Ditambahkan Sebagai Penerima Bansos.');
        }

        return redirect()->back()->with('error', 'Warga ini tidak berhak menerima bansos karena status survey bukan "kurang mampu".');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenerimaBansos $penerima_bansos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenerimaBansos $penerima_bansos)
    {
        return view('admin.penerima_bansos.edit', compact('penerima_bansos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenerimaBansos $penerima_bansos)
    {
        $request->validate([
            'warga_id'       => 'required|exists:wargas,id',
            'bansos_id'      => 'required|exists:bansos,id',
            'tanggal_terima' => 'required|date',
            'status'         => 'required|string|in:diajukan,diterima,ditolak',
        ]);

        $penerima_bansos->update([
            'warga_id'       => $request->warga_id,
            'bansos_id'      => $request->bansos_id,
            'tanggal_terima' => $request->tanggal_terima,
            'status'         => $request->status,
        ]);

        return redirect()->route('admin.penerima_bansos.index')->with('success', 'Penerima Bansos Berhasil Diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenerimaBansos $penerima_bansos)
    {
        $penerima_bansos->delete();
        return redirect()->route('admin.penerima_bansos.index')->with('success', 'Penerima Bansos Berhasil Dihapus.');
    }
}
