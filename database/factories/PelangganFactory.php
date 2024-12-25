<?php

namespace Database\Factories;

use App\Models\Pelanggan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelangganFactory extends Factory
{
    protected $model = Pelanggan::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'alamat' => $this->faker->address,
            'no_telepon' => $this->faker->phoneNumber,
        ];
    }
}
