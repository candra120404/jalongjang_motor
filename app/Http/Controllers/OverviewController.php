<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\RekapAntrian;
use Carbon\Carbon;

class OverviewController extends Controller
{

    public function index()
    {
        $currentYear = Carbon::now()->year;

        // Ambil data berdasarkan tahun yang diminta
        $rekapData = RekapAntrian::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total_kendaraan) as total_kendaraan')
            ->groupBy('year', 'month')
            ->get();

        // Ambil semua tahun unik untuk filter
        $availableYears = RekapAntrian::selectRaw('YEAR(tanggal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $totalPelanggan = Pelanggan::count();

        return view('welcome', compact('rekapData', 'availableYears', 'totalPelanggan'));
    }
}
