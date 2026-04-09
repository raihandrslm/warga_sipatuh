<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\Api\WargaAuthController;
use App\Http\Controllers\WargaDashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Route default Laravel (boleh dibiarkan)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// =====================
// API WARGA
// =====================

// Login Warga → TIDAK pakai middleware sanctum (karena belum login)
Route::post('/warga/login', [WargaAuthController::class, 'login']);

// Semua route yang butuh autentikasi setelah login
Route::middleware('auth:sanctum')->group(function () {

    // Logout (opsional)
    Route::post('/warga/logout', [WargaAuthController::class, 'logout']);

    // Dashboard & fitur lain
    Route::get('/warga/dashboard', [WargaDashboardController::class, 'apiIndex']);
    Route::post('/warga/bayar/{id}', [WargaDashboardController::class, 'apiBayar']);

    // Contoh ambil profil sendiri
    Route::get('/warga/me', function (Request $request) {
        return $request->user();
    });
});