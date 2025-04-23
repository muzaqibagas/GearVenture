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
        Schema::create('promo_produk', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('produk_id');
            $table->decimal('diskon_persen', 5, 2);
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('promo_produk');
    }
};
