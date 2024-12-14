<?php
// App\Models\RekapAntrian.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapAntrian extends Model
{
    use HasFactory;

    protected $table = 'rekap_antrian';

    protected $fillable = [
        'tanggal_awal',
        'tanggal_akhir',
        'total_kendaraan',
    ];
}
