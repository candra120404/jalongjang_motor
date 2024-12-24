<?php

namespace App\Http\Controllers;

use App\Models\AntrianCuci;
use App\Models\RekapAntrian;
use Illuminate\Http\Request;

class AntrianCuciController extends Controller
{
    public function index()
    {
        $antrian = AntrianCuci::with('kendaraan.pelanggan')->paginate(5);
        return view('admin.index', compact('antrian'));
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

        // Redirect kembali ke halaman daftar antrian dengan pesan sukses
        return redirect()->route('antrian.index')->with('success', 'Status antrian berhasil diperbarui.');
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
