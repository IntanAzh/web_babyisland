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
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');            // primary key sesuai nama kolom di DB
            $table->string('name_produk', 50)->nullable();
            $table->longText('deskripsi')->nullable();
            $table->double('harga')->nullable();
            $table->integer('stok')->nullable();


            $table->unsignedInteger('id_kategori')->nullable();

            $table->binary('image')->nullable();

            $table->timestamps();

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('kategori')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
