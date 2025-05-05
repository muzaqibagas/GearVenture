<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika nama model sama dengan tabel)
    protected $table = 'konten';

    // Kolom yang bisa diisi (mass assignment)
    protected $fillable = [
        'diskon',
        'produk_id'       
    ];

    // (opsional) Format tanggal yang digunakan Laravel
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'produk_id', 'id');
    }    

}
