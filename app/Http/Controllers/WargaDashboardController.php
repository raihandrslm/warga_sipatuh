<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TransaksiIuran;
use App\Models\PenerimaBansos;
use App\Models\Surat;

class WargaDashboardController extends Controller
{
    public function index()
    {
        $warga = Auth::guard('warga')->user();

        if (!$warga) {
            return redirect()->route('warga.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data transaksi terbaru untuk tabel utama
        $transaksi = TransaksiIuran::with('iuran')
            ->where('warga_id', $warga->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Ambil history pembayaran per bulan (urutkan berdasarkan bulan)
        $historyIuran = TransaksiIuran::with('iuran')
            ->where('warga_id', $warga->id)
            ->orderBy('tanggal', 'desc') // pastikan field bulan ada
            ->get();

        // Ambil data penerima bansos
        $penerimaBansos = PenerimaBansos::with('bansos')
            ->where('warga_id', $warga->id)
            ->get();

        $suratWarga = Surat::where('warga_id', auth('warga')->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('warga.dashboard', compact('warga', 'transaksi', 'historyIuran', 'penerimaBansos', 'suratWarga'));
    }

    // Proses pembayaran
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