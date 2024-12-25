<?php

namespace App\Http\Controllers;

use App\Models\AntrianCuci;
use App\Models\RekapAntrian;
use Illuminate\Http\Request;
use Carbon\Carbon;


class AntrianCuciController extends Controller
{



    public function index(Request $request)
    {
        $search = $request->input('search');
        $month = $request->input('month') ?: Carbon::now()->month; // Default ke bulan saat ini jika tidak dipilih
        $year = $request->input('year') ?: Carbon::now()->year; // Default ke tahun saat ini jika tidak dipilih

        $query = AntrianCuci::with('kendaraan.pelanggan');

        // Filter berdasarkan bulan jika ada
        if ($month) {
            $query->whereMonth('tanggal_antrian', $month);
        }

        // Filter berdasarkan tahun jika ada
        if ($year) {
            $query->whereYear('tanggal_antrian', $year);
        }

        // Tambahkan filter pencarian
        $query->when($search, function ($query) use ($search) {
            return $query->whereHas('kendaraan.pelanggan', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            });
        });

        $antrian = $query->paginate(5)
            ->appends(['search' => $search, 'month' => $month, 'year' => $year])
            ->fragment('antrian_cuci');

        return view('admin.index', compact(
            'antrian',
            'search',
            'month',
            'year'
        ));
    }

    public function show($id)
    {
        $antrian_detail = AntrianCuci::with(['kendaraan.pelanggan'])->findOrFail($id);
        return response()->json($antrian_detail);
    }


    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraan,id',
            'tanggal_antrian' => 'required|date',
            'waktu_antrian' => 'required|date_format:H:i',
            'status' => 'required|in:menunggu,selesai',
        ]);

        AntrianCuci::create($request->all());
        return redirect()->route('admin.index')->with('success', 'Antrian berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'status' => 'required', // Validasi memastikan status dikirim
        ]);

        // Cari antrian yang akan diupdate
        $statusUpdate = AntrianCuci::findOrFail($id);
        $statusUpdate->status = $request->input('status');
        $statusUpdate->save();

        // Jika status sudah selesai, simpan data ke dalam RekapAntrian
        if ($statusUpdate->status == 'selesai') {
            $this->saveToRekapAntrian($statusUpdate);
        }

        return redirect()
            ->route('antrian.index', ['page' => $request->page])
            ->with('success', 'Status berhasil diubah!');
    }
    // Fungsi untuk menyimpan data ke tabel RekapAntrian
    private function saveToRekapAntrian(AntrianCuci $antrianCuci)
    {
        // Pastikan tanggal sudah dalam format yang benar
        $tanggalAntrian = $antrianCuci->tanggal_antrian;  // $tanggalAntrian sudah berupa string tanggal

        // Cari rekap yang sudah ada berdasarkan tanggal antrian
        $rekap = RekapAntrian::where('tanggal', $tanggalAntrian)
            ->first();

        // Jika rekap tidak ada, buat rekap baru
        if (!$rekap) {
            $rekap = RekapAntrian::create([
                'tanggal' => $tanggalAntrian,  // Pastikan tanggal disertakan
                'total_kendaraan' => 1, // Kendaraan pertama dalam periode tersebut
            ]);
        } else {
            // Jika rekap ada, update jumlah kendaraan
            $rekap->total_kendaraan += 1;
            $rekap->save();
        }
    }
}
