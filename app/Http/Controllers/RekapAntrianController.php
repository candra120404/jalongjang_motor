<?php

namespace App\Http\Controllers;

use App\Models\RekapAntrian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RekapAntrianController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data rekap antrian, kelompokan berdasarkan bulan dan tahun, kemudian jumlahkan total kendaraan
        $rekapData = RekapAntrian::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total_kendaraan) as total_kendaraan')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Kirim data ke tampilan
        return view('rekap.mingguan', compact('rekapData'));
    }

    public function cetakAntrianPerTanggal($tglAwal, $tglAkhir)
    {
        // Ambil data rekap dari database berdasarkan rentang tanggal
        $rekapPerTanggal = RekapAntrian::whereBetween('tanggal', [$tglAwal, $tglAkhir])->get();

        // Cek jika data tidak ditemukan
        if ($rekapPerTanggal->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data untuk rentang tanggal yang dipilih.');
        }

        // Buat PDF dengan data yang diambil
        $pdf = Pdf::loadView('rekap.rekap', [
            'rekap' => $rekapPerTanggal,
            'tglAwal' => $tglAwal,
            'tglAkhir' => $tglAkhir,
        ]);

        // Unduh file PDF
        return $pdf->download("rekap-antrian-{$tglAwal}-sampai-{$tglAkhir}.pdf");
    }
}
