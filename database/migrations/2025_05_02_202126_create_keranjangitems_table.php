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
        Schema::create('keranjang_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('keranjang_id');
            $table->unsignedBigInteger('produk_id');            
            $table->integer('jumlah');
            $table->integer('harga_asli');
            $table->integer('harga_setelah_diskon');
            $table->integer('diskon');
            $table->integer('total_layanan')->default(0);
            $table->json('tambahan')->nullable(); // jika ingin simpan sebagai JSON
            $table->json('qty_tambahan')->nullable();
            $table->timestamps();
        
            $table->foreign('keranjang_id')->references('id')->on('keranjang')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
            
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjang_items');
    }
};
