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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('produk_id');
            $table->string('nama_pengguna');
            $table->string('no_handphone', 15);
            $table->text('alamat');
            $table->string('email');
            $table->integer('jumlah');
            $table->date('tanggal');
            $table->decimal('total_harga', 10, 2);
            $table->string('status')->default('belum lunas');
            $table->boolean('is_new')->default(true);
            $table->integer('durasi');
            $table->json('tambahan')->nullable(); // jika ingin simpan sebagai JSON
            $table->json('qty_tambahan')->nullable();        
            $table->string('bukti_pembayaran')->nullable();
            $table->string('status_peminjaman')->default('belum_dipinjam');
            $table->foreignId('keranjang_id')->nullable()->constrained('keranjang')->onDelete('set null');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');            
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
