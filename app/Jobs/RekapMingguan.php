<?php

// app/Jobs/RekapMingguan.php

namespace App\Jobs;

use App\Models\AntrianCuci;
use App\Models\RekapAntrian;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RekapMingguan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        // Ambil tanggal minggu lalu
        $weekAgo = Carbon::now()->subWeek();

        // Pindahkan data yang lebih dari satu minggu ke rekap_antrian
        $antrian = AntrianCuci::where('tanggal_antrian', '<', $weekAgo)->get();

        foreach ($antrian as $a) {
            RekapAntrian::create([
                'kendaraan_id' => $a->kendaraan_id,
                'status' => $a->status,
                'tanggal_antrian' => $a->tanggal_antrian,
            ]);
        }

        // Hapus data yang sudah dipindahkan
        AntrianCuci::where('tanggal_antrian', '<', $weekAgo)->delete();
    }
}

