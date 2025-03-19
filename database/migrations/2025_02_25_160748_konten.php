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
        Schema::create('konten', function (Blueprint $table) {
            $table->id('id_konten');
            $table->unsignedBigInteger('admin_id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->date('tanggal');
            $table->string('tipe');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('konten');
    }
};
