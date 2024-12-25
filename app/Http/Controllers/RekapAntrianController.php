<?php

namespace App\Http\Controllers;

use App\Models\RekapAntrian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RekapAntrianController extends Controller
{
    public function index(Request $request)
    {
        // Kirim data ke tampilan
        return view('rekap.mingguan');
    }

    public function cetakAntrianPerTanggal($tglAwal, $tglAkhir)
    {
        // Ambil data rekap dari database berdasarkan rentang tanggal
        $rekapPerTanggal = RekapAntrian::whereBetween('tanggal', [$tglAwal, $tglAkhir])->get();

        // Cek jika data tidak ditemukan
        if ($rekapPerTanggal->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk rentang tanggal yang dipilih.');
        }

        // Hitung total kendaraan
        $totalKendaraan = $rekapPerTanggal->sum('total_kendaraan');
        // Buat PDF dengan data yang diambil
        $pdf = Pdf::loadView('rekap.rekap', [
            'rekap' => $rekapPerTanggal,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
            'totalKendaraan' => $totalKendaraan,
        ]);

        // Unduh file PDF
        return $pdf->download("rekap-antrian-{$tglAwal}-sampai-{$tglAkhir}.pdf");
    }
}
