<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $table = 'kendaraan';
    protected $fillable = ['pelanggan_id', 'jenis_kendaraan', 'merk', 'tahun', 'nomor_polisi'];

    // Relasi ke Pelanggan (Many-to-One)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // Relasi ke Antrian Cuci (One-to-Many)
    public function antrianCuci()
    {
        return $this->hasMany(AntrianCuci::class);
    }
    public function rekapAntrian()
    {
        return $this->hasMany(RekapAntrian::class);
    }
}
