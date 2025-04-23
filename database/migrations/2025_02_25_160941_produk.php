<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id');
            $table->string('nama');
            $table->text('deskripsi');
            $table->integer('stok');
            $table->decimal('harga_sewa', 10, 2);
            $table->string('foto');
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('produk');
    }
};
