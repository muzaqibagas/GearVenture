<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FotoBarang extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'foto'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}

