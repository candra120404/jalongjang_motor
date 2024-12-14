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
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('pelanggan_id');
            $table->string('jenis_kendaraan');
            $table->string('merk');
            $table->integer('tahun');
            $table->string('nomor_polisi');
            $table->timestamps();
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan');
    }
};
