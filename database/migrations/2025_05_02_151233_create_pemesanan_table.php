<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id('id_order');
            $table->bigInteger('nomor_hp')->nullable();
            $table->longText('alamat')->nullable();
            $table->date('waktu_pinjam')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->date('waktu_kembali')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('Total')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->unsignedBigInteger('id_produk')->nullable();
            $table->unsignedBigInteger('id_kategori')->nullable();

            // Buat relasi
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('set null');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
