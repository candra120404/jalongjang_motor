<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AntrianCuciController;
use App\Http\Controllers\RekapAntrianController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OverviewController;

// Rute untuk tamu (guest)
Route::middleware('guest')->group(function () {
    Route::get('/', [PelangganController::class, 'index']);
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'proccess'])->name('login.proccess');
});

// Rute untuk pengguna yang sudah login (auth)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/overview', [OverviewController::class, 'index'])->name('overview.index');
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('antrian', AntrianCuciController::class);
    Route::put('/antrian/{antrianCuci}', [AntrianCuciController::class, 'update'])->name('antrian.update');
    Route::get('/rekap', [RekapAntrianController::class, 'index'])->name('rekap.mingguan');
    Route::get('/rekap/{tglAwal}/{tglAkhir}', [RekapAntrianController::class, 'cetakAntrianPerTanggal'])->name('rekap.cetakAntrianPerTanggal');
    Route::get('/rekap/download-pdf', [RekapAntrianController::class, 'downloadRekapPdf'])->name('rekap.downloadPdf');
});
