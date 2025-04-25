<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('konten', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->integer('diskon');            

            // Foreign key constraint ke tabel produk
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');            
        });
    }

    public function down()
    {
        Schema::dropIfExists('konten');
    }
};
