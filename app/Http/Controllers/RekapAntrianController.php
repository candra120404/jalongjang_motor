<?php

// app/Http/Controllers/RekapAntrianController.php
namespace App\Http\Controllers;

use App\Models\RekapAntrian;

class RekapAntrianController extends Controller
{
    public function index()
    {
        $rekapAntrian = RekapAntrian::all(); // Ambil semua data dari rekap_antrian
        return view('rekap.mingguan', compact('rekapAntrian'));
    }
}
