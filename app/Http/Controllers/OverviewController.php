<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class OverviewController extends Controller
{
    public function index()
    {
        $totalPelanggan = Pelanggan::count();
        return view('welcome', compact('totalPelanggan'));
    }
}
