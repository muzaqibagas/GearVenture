<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukPopuler extends Model
{
    use HasFactory;

    protected $table = 'produk_populer';

    protected $fillable = [
        'produk_id',        
        'rating',
        'created_at',
        'updated_at',
    ];

    public function produk()
    {
        return $this->belongsTo(Barang::class, 'produk_id');
    }
    
}
