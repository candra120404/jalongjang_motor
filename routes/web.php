<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\AntrianCuciController;
use App\Http\Controllers\RekapAntrianController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [PelangganController::class, 'index']);


Route::resource('pelanggan', PelangganController::class);
Route::resource('antrian', AntrianCuciController::class);
Route::put('/antrian/{antrianCuci}', [AntrianCuciController::class, 'update'])->name('antrian.update');
Route::get('/rekap', [RekapAntrianController::class, 'index'])->name('rekap.mingguan');
Route::get('/rekap/generate', [RekapAntrianController::class, 'generateRekap'])->name('rekap.generate');
Route::get('/rekap/chart', [RekapAntrianController::class, 'showChart'])->name('rekap.chart');
Route::get('/rekap/download-pdf', [RekapAntrianController::class, 'downloadRekapPdf'])->name('rekap.downloadPdf');

