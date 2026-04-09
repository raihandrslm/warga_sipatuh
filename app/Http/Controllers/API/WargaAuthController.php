<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warga;

class WargaAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nik'  => 'required|string',
            'nama' => 'required|string',
        ]);

        $warga = Warga::where('nik', $request->nik)
                      ->where('nama', $request->nama)
                      ->first();

        if (!$warga) {
            return response()->json([
                'message' => 'NIK atau Nama tidak ditemukan!'
            ], 401);
        }

        // Buat token Sanctum
        $token = $warga->createToken('warga-app-token')->plainTextToken;

        return response()->json([
            'success'    => true,
            'message'    => 'Login berhasil',
            'warga'      => $warga->only(['id', 'nik', 'nama', 'alamat', 'status']),
            'token'      => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil'
        ], 200);
    }
}