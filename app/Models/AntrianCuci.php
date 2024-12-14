<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class AntrianCuci extends Model
{
    use HasFactory;
    protected $table = 'antrian_cuci';
    protected $fillable = ['kendaraan_id', 'tanggal_antrian', 'waktu_antrian', 'status'];

    // Relasi ke Kendaraan (Many-to-One)
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
