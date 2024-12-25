<?php

namespace Database\Factories;

use App\Models\AntrianCuci;
use App\Models\Kendaraan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class AntrianCuciFactory extends Factory
{
    protected $model = AntrianCuci::class;

    public function definition()
    {
        // Menghasilkan tanggal acak untuk bulan November 2023 atau 2024
        $date = $this->faker->dateTimeBetween('2023-11-01', '2024-11-30');

        return [
            'kendaraan_id' => Kendaraan::factory(), // Menggunakan factory untuk model Kendaraan
            'tanggal_antrian' => $date->format('Y-m-d'),
            'waktu_antrian' => $this->faker->time('H:i:s'),
            'status' => 'selesai', //$this->faker->randomElement(['menunggu', 'selesai'])
        ];
    }
}
