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
Route::get('/rekap', [RekapAntrianController::class, 'index'])->name('rekap.index');
