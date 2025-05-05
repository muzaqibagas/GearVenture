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
        'nama_pengguna',
        'no_handphone',
        'alamat',
        'durasi',
        'email',
        'jumlah',
        'tanggal',
        'total_harga',
        'status',
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
}
