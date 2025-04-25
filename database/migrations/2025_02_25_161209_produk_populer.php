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
        Schema::create('produk_populer', function (Blueprint $table) {
            $table->id(); // id otomatis
            $table->unsignedBigInteger('produk_id'); // FK ke tabel produk            
            $table->decimal('harga', 10, 2); // harga produk
            $table->integer('Rating'); // rating bintang (1 - 5)
            $table->timestamps(); // created_at & updated_at

            // Menambahkan foreign key constraint
            $table->foreign('produk_id')
                  ->references('id') // ke kolom id di tabel produk
                  ->on('produk') // di tabel produk
                  ->onDelete('cascade'); // menghapus produk_populer jika produk dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_populer');
    }
};
