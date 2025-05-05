<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriProduk;


class Barang extends Model
{
    // Nama tabel
    protected $table = 'produk';

    // Primary key
    protected $primaryKey = 'id';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama',
        'deskripsi',
        'stok',        
        'harga_sewa',
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
        return $this->belongsTo(KategoriProduk::class, 'kategori_id', 'id');
    }

    public function konten()
    {
        return $this->hasOne(Konten::class, 'produk_id');
    }
    public function ProdukPopuler()
    {
        return $this->hasOne(ProdukPopuler::class, 'produk_id');
    }
    public function fotoBarangs()
    {
        return $this->hasMany(FotoBarang::class, 'barang_id');
    }

}
