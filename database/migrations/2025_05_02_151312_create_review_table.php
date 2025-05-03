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
        Schema::create('review', function (Blueprint $table) {
            $table->id('id_review');

            // Foreign keys
            $table->unsignedBigInteger('id_user')->nullable();
            $table->unsignedBigInteger('id_produk')->nullable();

            // Comment
            $table->string('comment', 500)->nullable();

            // Timestamp
            $table->timestamp('dibuat')->useCurrent();

            // Foreign key constraints
            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('set null');
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review');
    }
};
