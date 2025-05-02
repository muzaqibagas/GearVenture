<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('foto_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('produk')->onDelete('cascade');
            $table->string('foto'); // path/filename
            $table->timestamps();
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('foto_barangs');
    }
};
