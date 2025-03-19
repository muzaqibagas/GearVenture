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
        Schema::create('produk_populer', function (Blueprint $table) {
            $table->id('id_populer');
            $table->unsignedBigInteger('produk_id');
            $table->integer('jumlah_terjual');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('produk_populer');
    }
};
