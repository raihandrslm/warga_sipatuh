<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;

class WargaLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('warga.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
        ]);

        // Cek data warga berdasarkan NIK dan nama
        $warga = Warga::where('nik', $request->nik)
            ->where('nama', $request->nama)
            ->first();

        if ($warga) {
            // Login manual ke guard 'warga' tanpa password
            Auth::guard('warga')->login($warga);

            // Redirect ke dashboard warga
            return redirect()->intended(route('warga.dashboard'));
        }

        return back()->with('error', 'NIK atau Nama tidak ditemukan!');
    }

    public function logout(Request $request)
    {
        Auth::guard('warga')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('warga.login');
    }
}
