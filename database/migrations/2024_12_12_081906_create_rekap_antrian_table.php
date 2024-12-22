<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekap_antrian', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // Tanggal
            $table->integer('total_kendaraan'); // Total kendaraan dalam periode rekap
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_antrian');
    }
};
