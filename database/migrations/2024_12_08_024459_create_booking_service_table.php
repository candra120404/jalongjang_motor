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
        Schema::create('booking_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kendaraan_id');
            $table->date('tanggal_servis');
            $table->time('waktu_servis');
            $table->string('jenis_servis');
            $table->enum('status', ['dijadwalkan', 'selesai']);
            $table->timestamps();
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_service');
    }
};
