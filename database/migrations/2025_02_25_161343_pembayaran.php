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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('transaksi_id');
            $table->string('metode');
            $table->string('status');
            $table->string('bukti_pembayaran');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
