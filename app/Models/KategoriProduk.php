<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    // Nama tabel
    protected $table = 'kategori_produk';

    // Primary key custom
    protected $primaryKey = 'id';

    // Auto-increment harus true jika menggunakan id biasa
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama',
    ];

    // Jika ingin timestamps otomatis
    public $timestamps = false;
}
