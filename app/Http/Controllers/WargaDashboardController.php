<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiIuran;
use App\Models\PenerimaBansos;
use App\Models\Surat;

class WargaDashboardController extends Controller
{
    /**
     * API Dashboard untuk Warga (Flutter / Postman)
     */
    public function apiIndex(Request $request)
    {
        $warga = $request->user();   // Ini yang benar untuk Sanctum (bukan Auth::guard)

        if (!$warga) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Ambil data transaksi terbaru
        $transaksi = TransaksiIuran::with('iuran')
            ->where('warga_id', $warga->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // History pembayaran
        $historyIuran = TransaksiIuran::with('iuran')
            ->where('warga_id', $warga->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Data bansos
        $penerimaBansos = PenerimaBansos::with('bansos')
            ->where('warga_id', $warga->id)
            ->get();

        // Data surat
        $suratWarga = Surat::where('warga_id', $warga->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data dashboard berhasil diambil',
            'warga'   => [
                'id'      => $warga->id,
                'nik'     => $warga->nik,
                'nama'    => $warga->nama,
                'alamat'  => $warga->alamat,
                'status'  => $warga->status,
            ],
            'transaksi'      => $transaksi,
            'history_iuran'  => $historyIuran,
            'penerima_bansos'=> $penerimaBansos,
            'surat_warga'    => $suratWarga,
        ]);
    }

    /**
     * API Bayar Iuran
     */
    public function apiBayar(Request $request, $id)
    {
        $warga = $request->user();

        $transaksi = TransaksiIuran::findOrFail($id);

        // Cek kepemilikan
        if ($transaksi->warga_id != $warga->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk membayar transaksi ini.'
            ], 403);
        }

        $transaksi->update([
            'status_bayar' => 'lunas',
            'tanggal'      => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil! Terima kasih sudah melunasi iuran.',
            'transaksi' => $transaksi
        ]);
    }

    // Method lama untuk web tetap dipertahankan
    public function index()
    {
        $warga = Auth::guard('warga')->user();

        if (!$warga) {
            return redirect()->route('warga.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $transaksi = TransaksiIuran::with('iuran')
            ->where('warga_id', $warga->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $historyIuran = TransaksiIuran::with('iuran')
            ->where('warga_id', $warga->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $penerimaBansos = PenerimaBansos::with('bansos')
            ->where('warga_id', $warga->id)
            ->get();

        $suratWarga = Surat::where('warga_id', auth('warga')->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('warga.dashboard', compact('warga', 'transaksi', 'historyIuran', 'penerimaBansos', 'suratWarga'));
    }

    public function bayar($id)
    {
        $transaksi = TransaksiIuran::findOrFail($id);

        if ($transaksi->warga_id != Auth::guard('warga')->id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk membayar transaksi ini.');
        }

        $transaksi->update([
            'status_bayar' => 'lunas',
            'tanggal' => now(),
        ]);

        return back()->with('success', 'Pembayaran berhasil! Terima kasih sudah melunasi iuran.');
    }
}