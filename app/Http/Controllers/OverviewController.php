<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\RekapAntrian;

class OverviewController extends Controller
{
    public function index()
    {
        // Ambil data rekap antrian, kelompokan berdasarkan bulan dan tahun, kemudian jumlahkan total kendaraan
        $rekapData = RekapAntrian::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total_kendaraan) as total_kendaraan')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $totalPelanggan = Pelanggan::count();
        return view('welcome', compact('totalPelanggan', 'rekapData'));
    }
}
