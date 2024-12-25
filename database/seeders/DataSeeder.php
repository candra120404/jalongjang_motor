<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Models\Kendaraan;
use App\Models\AntrianCuci;
use App\Models\RekapAntrian;

class DataSeeder extends Seeder
{
    public function run()
    {
        // Membuat 10 pelanggan dengan kendaraan dan antrian cuci mereka
        Pelanggan::factory()->count(10)->create()->each(function ($pelanggan) {
            // Setiap pelanggan mendapatkan 2 kendaraan
            $kendaraan = Kendaraan::factory()->count(2)->create(['pelanggan_id' => $pelanggan->id]);

            // Setiap kendaraan mendapatkan 3 antrian cuci
            $kendaraan->each(function ($kendaraan) {
                // Buat 3 antrian cuci untuk setiap kendaraan
                $antrianCucis = AntrianCuci::factory()->count(3)->create(['kendaraan_id' => $kendaraan->id]);

                // Panggil saveToRekapAntrian untuk setiap antrian cuci
                $antrianCucis->each(function ($antrianCuci) {
                    $this->saveToRekapAntrian($antrianCuci);
                });
            });
        });
    }

    // Fungsi untuk menyimpan data ke RekapAntrian
    private function saveToRekapAntrian(AntrianCuci $antrianCuci)
    {
        $tanggalAntrian = $antrianCuci->tanggal_antrian;

        // Cari rekap yang sudah ada berdasarkan tanggal antrian
        $rekap = RekapAntrian::where('tanggal', $tanggalAntrian)->first();

        // Jika rekap tidak ada, buat rekap baru
        if (!$rekap) {
            $rekap = RekapAntrian::create([
                'tanggal' => $tanggalAntrian, // Pastikan tanggal disertakan
                'total_kendaraan' => 1, // Kendaraan pertama pada tanggal tersebut
            ]);
        } else {
            // Jika rekap ada, update jumlah kendaraan
            $rekap->total_kendaraan += 1;
            $rekap->save();
        }
    }
}
