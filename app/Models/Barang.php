<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    // Nama tabel
    protected $table = 'produk';

    // Primary key
    protected $primaryKey = 'id_produk';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama',
        'deskripsi',
        'stok',
        'harga_sewa',
        'foto',
        'kategori_id',
    ];

    // Jika tidak ingin timestamps default Laravel (created_at dan updated_at), set ini ke false
    public $timestamps = true;

    // Format timestamp jika ingin mengubah (opsional)
    protected $casts = [
        'harga_sewa' => 'decimal:2',
        'stok' => 'integer',
    ];

    // Relasi ke tabel kategori (asumsi relasi many-to-one)
    public function kategori()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id', 'id_kategori');
    }
}
