<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = [
        'user_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',
        'total_harga',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Item Keranjang (nanti kita buat modelnya juga)
    public function items()
    {
        return $this->hasMany(KeranjangItem::class);
    }
}
