<?php

namespace App\Http\Controllers;

use App\Models\TransaksiIuran;
use App\Models\Warga;
use App\Models\Iuran;
use Illuminate\Http\Request;

class TransaksiIuranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = TransaksiIuran::with(['warga', 'iuran'])->latest()->get();
        $warga = Warga::all();
        $iuran = Iuran::all();

        return view('admin.transaksi_iuran.index', compact('transaksi', 'warga', 'iuran'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.transaksi_iuran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'warga_id' => 'required|exists:wargas,id',
        'iuran_id' => 'required|exists:iurans,id',
        'jumlah_bayar' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
    ]);

    TransaksiIuran::create([
        'warga_id' => $request->warga_id,
        'iuran_id' => $request->iuran_id,
        'jumlah_bayar' => $request->jumlah_bayar,
        'tanggal' => $request->tanggal,
        'status_bayar' => 'belum',
    ]);

    return redirect()->route('admin.transaksi_iuran.index')->with('success', 'Transaksi Berhasil Ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(TransaksiIuran $transaksi_iuran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransaksiIuran $transaksi_iuran)
    {
        return view('admin.transaksi_iuran.edit', compact('transaksi_iuran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransaksiIuran $transaksi_iuran)
    {
        $request->validate([
        'warga_id' => 'required|exists:wargas,id',
        'iuran_id' => 'required|exists:iurans,id',
        'jumlah_bayar' => 'required|numeric|min:0',
        'tanggal' => 'required|date',
        'status_bayar' => 'required|in:belum,lunas',
    ]);

    $transaksiIuran->update($request->all());

    return redirect()->route('admin.transaksi_iuran.index')->with('success', 'Transaksi Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransaksiIuran $transaksi_iuran)
    {
        $transaksi_iuran->delete();
        return redirect()->route('admin.transaksi_iuran.index')->with('success', 'Transaksi Berhasil dihapus.');
    }
}
