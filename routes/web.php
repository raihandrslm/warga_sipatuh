<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StatusKeluargaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\TransaksiIuranController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TrackingSuratController;
use App\Http\Controllers\SurveyStatusController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\PenerimaBansosController;
use App\Http\Controllers\RtDashboardController;
use App\Http\Controllers\Auth\WargaLoginController;
use App\Http\Controllers\WargaDashboardController;
use App\Http\Controllers\SuratWargaController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsRt;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    return redirect()->route($role . '.dashboard');
})->middleware('auth')->name('dashboard');

Route::group([ 
    'prefix' => 'admin', 
    'as' => 'admin.',
    'middleware' => ['auth', IsAdmin::class]
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('status_keluarga', StatusKeluargaController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);
    Route::resource('iuran', IuranController::class);
    Route::resource('transaksi_iuran', TransaksiIuranController::class);
    Route::resource('surat', SuratController::class);
    Route::resource('tracking_surat', TrackingSuratController::class);
    Route::resource('survey_status', SurveyStatusController::class);
    Route::resource('bansos', BansosController::class)->parameters(['bansos' => 'bansos']);
    Route::resource('penerima_bansos', PenerimaBansosController::class)->parameters(['penerima_bansos' => 'penerima_bansos']);
});

Route::group([ 
    'prefix' => 'rt', 
    'as' => 'rt.',
    'middleware' => ['auth', IsRt::class]
], function () {
    Route::get('/', [RtDashboardController::class, 'index'])->name('dashboard');
    Route::resource('tracking_surat', TrackingSuratController::class);
});

Route::prefix('warga')->name('warga.')->group(function () {
    Route::get('/login', [WargaLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [WargaLoginController::class, 'login'])->name('login.submit');
    Route::get('/logout', [WargaLoginController::class, 'logout'])->name('logout');

    // gunakan guard warga, bukan middleware 'warga'
    Route::middleware('auth:warga')->group(function () {
        Route::get('/dashboard', [WargaDashboardController::class, 'index'])->name('dashboard');
        Route::post('/transaksi/{id}/bayar', [WargaDashboardController::class, 'bayar'])->name('transaksi.bayar');
        Route::resource('surat', SuratWargaController::class);
    });
});
