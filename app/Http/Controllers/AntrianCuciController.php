<?php

namespace App\Http\Controllers;

use App\Models\AntrianCuci;
use App\Models\Kendaraan;
use App\Models\RekapAntrian;
use Illuminate\Http\Request;

class AntrianCuciController extends Controller
{
    public function index()
    {
        $antrian = AntrianCuci::with('kendaraan.pelanggan')->get();
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
    $statusUpdate = AntrianCuci::findOrFail($id);

    $statusUpdate->status = $request->input('status');
    $statusUpdate->save();

    // Redirect kembali ke halaman daftar antrian dengan pesan sukses
    return redirect()->route('antrian.index')->with('success', 'Status antrian berhasil diperbarui.');
}

}
