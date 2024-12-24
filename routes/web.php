<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AntrianCuciController;
use App\Http\Controllers\RekapAntrianController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OverviewController;

Route::get('/', function () {
    return redirect()->route('pelanggan.index');
});

Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
Route::get('/pelanggan/cek-antrian', [PelangganController::class, 'cekAntrianTerkini'])->name('pelanggan.cekAntrianTerkini');


// Rute untuk tamu (guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [LoginController::class, 'proccess'])->name('login.proccess');
});

// Rute untuk pengguna yang sudah login (auth)
Route::middleware('auth')->group(function () {
    Route::get('/overview', [OverviewController::class, 'index'])->name('overview.index');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('antrian', AntrianCuciController::class);
    Route::put('/antrian/{antrianCuci}', [AntrianCuciController::class, 'update'])->name('antrian.update');
    Route::get('/rekap', [RekapAntrianController::class, 'index'])->name('rekap.mingguan');
    Route::get('/rekap/{tglAwal}/{tglAkhir}', [RekapAntrianController::class, 'cetakAntrianPerTanggal'])->name('rekap.cetakAntrianPerTanggal');
    Route::get('/rekap/download-pdf', [RekapAntrianController::class, 'downloadRekapPdf'])->name('rekap.downloadPdf');
});
