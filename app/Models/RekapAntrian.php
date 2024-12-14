<?php
// App\Models\RekapAntrian.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapAntrian extends Model
{
    use HasFactory;
    protected $table = 'rekap_antrian';
    protected $fillable = ['kendaraan_id', 'tanggal_antrian', 'status'];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
