<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriProdukTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_produk', function (Blueprint $table) {
            $table->id('id_kategori'); // primary key
            $table->string('nama');    // nama kategori
            $table->timestamps();      // created_at & updated_at (optional)
        });
    }

    public function down()
    {
        Schema::dropIfExists('kategori_produk');
    }
}
