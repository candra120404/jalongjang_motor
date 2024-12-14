<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\AntrianCuci;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        
        return view('pelanggan.index');
    }

   

    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_telepon' => 'required|string',
        'kendaraan' => 'required|array',
        'kendaraan.*.jenis_kendaraan' => 'required|string',
        'kendaraan.*.merk' => 'required|string',
        'kendaraan.*.tahun' => 'required|integer',
        'kendaraan.*.nomor_polisi' => 'required|string',
    ]);

    // Buat Pelanggan
    $pelanggan = Pelanggan::create($request->only(['nama', 'alamat', 'no_telepon']));

    foreach ($request->kendaraan as $kendaraanData) {
        $kendaraanData['pelanggan_id'] = $pelanggan->id;

        // Buat Kendaraan
        $kendaraan = Kendaraan::create($kendaraanData);

        // Tambahkan data ke antrian cuci
        AntrianCuci::create([
            'kendaraan_id' => $kendaraan->id,
            'tanggal_antrian' => now()->toDateString(),
            'waktu_antrian' => now()->toTimeString(),
            'status' => 'menunggu', // Status default
        ]);
    }

    return redirect()->route('pelanggan.index')->with('success', 'Data berhasil disimpan.');
}

}
