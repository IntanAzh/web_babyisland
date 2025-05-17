<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemesanan_id')->constrained('pemesanan')->onDelete('cascade');
            $table->string('nama_bank', 50);
            $table->string('nama_pemilik', 100);
            $table->string('nomor_rekening', 50);
            $table->string('gambar_bukti');
            $table->enum('status', ['pending', 'diverifikasi', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};