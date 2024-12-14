<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

// app/Console/Commands/RunRekapMingguan.php

namespace App\Console\Commands;

use App\Jobs\RekapMingguan;
use Illuminate\Console\Command;

class RunRekapMingguan extends Command
{
    // Nama dan deskripsi command
    protected $signature = 'rekap:run-every-10-seconds';
    protected $description = 'Jalankan job RekapMingguan setiap 10 detik';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Loop yang menjalankan job setiap 10 detik
        while (true) {
            RekapMingguan::dispatch(); // Dispatch job
            sleep(10); // Delay 10 detik
        }
    }
}
