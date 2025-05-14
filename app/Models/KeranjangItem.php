<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    use HasFactory;

    protected $table = 'keranjang_items';

    protected $fillable = [
        'keranjang_id',
        'produk_id',
        'jumlah',
        'harga_asli',
        'harga_setelah_diskon',
        'diskon',
        'total_layanan',
        'tambahan',
        'qty_tambahan',
    ];

    protected $casts = [
        'tambahan' => 'array',
        'qty_tambahan' => 'array',
    ];

    // Relasi ke Keranjang
    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'keranjang_id');
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Barang::class, 'produk_id');
    }

    
}
