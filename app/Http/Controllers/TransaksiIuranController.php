<?php

namespace App\Http\Controllers;

use App\Models\TransaksiIuran;
use App\Models\Warga;
use App\Models\Iuran;
use Illuminate\Http\Request;

class TransaksiIuranController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiIuran::with(['warga', 'iuran'])->latest();

        // FILTER STATUS BAYAR
        if ($request->filled('status_bayar')) {
            $query->where('status_bayar', $request->status_bayar);
        }

        $transaksi = $query->get();
        $warga = Warga::all();
        $iuran = Iuran::all();

        return view('admin.transaksi_iuran.index', compact(
            'transaksi',
            'warga',
            'iuran'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'iuran_id' => 'required|exists:iurans,id',
            'tanggal' => 'required|date',
        ]);

        // 🔒 Ambil harga langsung dari tabel iuran
        $iuran = Iuran::findOrFail($request->iuran_id);

        TransaksiIuran::create([
            'warga_id' => $request->warga_id,
            'iuran_id' => $request->iuran_id,
            'jumlah_bayar' => $iuran->harga,
            'tanggal' => $request->tanggal,
            'status_bayar' => 'belum',
        ]);

        return redirect()
            ->route('admin.transaksi_iuran.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function update(Request $request, TransaksiIuran $transaksi_iuran)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'iuran_id' => 'required|exists:iurans,id',
            'tanggal' => 'required|date',
            'status_bayar' => 'required|in:belum,lunas',
        ]);

        // 🔒 Ambil harga terbaru dari tabel iuran
        $iuran = Iuran::findOrFail($request->iuran_id);

        $transaksi_iuran->update([
            'warga_id' => $request->warga_id,
            'iuran_id' => $request->iuran_id,
            'jumlah_bayar' => $iuran->harga,
            'tanggal' => $request->tanggal,
            'status_bayar' => $request->status_bayar,
        ]);

        return redirect()
            ->route('admin.transaksi_iuran.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(TransaksiIuran $transaksi_iuran)
    {
        $transaksi_iuran->delete();

        return redirect()
            ->route('admin.transaksi_iuran.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
