<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('foto_produk', function (Blueprint $table) {
            $table->id('id'); // Primary Key
            $table->unsignedBigInteger('produk_id'); // Foreign Key ke tabel produk
            $table->string('foto'); // path atau nama file gambar
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('produk_id')
                ->references('id') // sesuaikan kalau di tabel produk bukan 'id'
                ->on('produk')
                ->onDelete('cascade'); // jika produk dihapus, foto-fotonya juga ikut terhapus
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_produk');
    }
};
