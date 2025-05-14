<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $table = 'transaksi';

    protected $fillable = [
        'id',
        'user_id',
        'produk_id',
        'keranjang_id',
        'nama_pengguna',
        'no_handphone',
        'alamat',
        'durasi',
        'email',
        'jumlah',
        'tanggal',
        'total_harga',
        'status',
        'is_new',        
        'tambahan',
        'qty_tambahan',
        'bukti_pembayaran',
        'status_peminjaman',
    ];

    protected $casts = [
        'tambahan' => 'array',
        'qty_tambahan' => 'array',
        'tanggal' => 'date',
        'total_harga' => 'decimal:2',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Barang::class);
    }

    // Relasi ke Keranjang
    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }
}
