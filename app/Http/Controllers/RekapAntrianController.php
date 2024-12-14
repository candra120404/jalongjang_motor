<?php
namespace App\Http\Controllers;

use App\Models\RekapAntrian;
use App\Models\AntrianCuci;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class RekapAntrianController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data rekap mingguan
        $rekapAntrian = RekapAntrian::orderBy('tanggal_awal', 'desc')->get();

        // Pagination manual
        $perPage = 5; // Jumlah item per halaman
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $paginatedRekap = new LengthAwarePaginator(
            $rekapAntrian->slice(($currentPage - 1) * $perPage, $perPage)->values(),
            $rekapAntrian->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Kirim data ke view
        return view('rekap.mingguan', compact('paginatedRekap'));
    }

    // Fungsi untuk generate rekap mingguan
    public function generateRekap()
    {
        // Cari minggu terakhir
        $startDate = now()->startOfWeek();
        $endDate = now()->endOfWeek();

        // Hitung total kendaraan yang sudah selesai cuci dalam periode tersebut
        $totalKendaraan = AntrianCuci::whereBetween('tanggal_antrian', [$startDate, $endDate])
            ->where('status', 'selesai') // Hanya kendaraan dengan status 'selesai'
            ->count();

        // Simpan ke tabel RekapAntrian
        RekapAntrian::create([
            'tanggal_awal' => $startDate,
            'tanggal_akhir' => $endDate,
            'total_kendaraan' => $totalKendaraan,
        ]);
        return redirect()->route('rekap.mingguan'); 
    }

    // Fungsi untuk download PDF rekap mingguan
    public function downloadRekapPdf()
    {
        // Ambil semua data rekap mingguan
        $rekap = RekapAntrian::all();

        // Membuat PDF dari view
        $pdf = Pdf::loadView('rekap.rekap', compact('rekap'));

        // Mengunduh file PDF
        return $pdf->download('rekap_antrian.pdf');
    }
}
