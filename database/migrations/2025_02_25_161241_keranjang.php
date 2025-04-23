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
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('keranjang');
    }
};
