<?php

namespace Database\Factories;

use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    protected $model = Kendaraan::class;

    public function definition()
    {
        return [
            'pelanggan_id' => Pelanggan::factory(), // Membuat pelanggan baru setiap kali kendaraan dibuat
            'jenis_kendaraan' => $this->faker->randomElement(['mobil', 'motor']),
            'merk' => $this->faker->company,
            'tahun' => $this->faker->year(),
            'nomor_polisi' => $this->faker->regexify('[A-Z]{1,2}[0-9]{1,4}[A-Z]{1,3}'),
        ];
    }
}
