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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');

            // Foreign keys
            $table->unsignedBigInteger('id_order')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();

            // Enums
            $table->enum('pembayaran', ['transfer'])->nullable();
            $table->enum('status', ['pending', 'lunas', 'gagal'])->nullable();

            // Timestamps
            $table->timestamp('dibuat')->useCurrent();

            // Foreign key constraints
            $table->foreign('id_order')->references('id_order')->on('pemesanan')->onDelete('set null');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
