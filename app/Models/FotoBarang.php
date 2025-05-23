<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class FotoBarang extends Model
{
    use HasFactory;
    protected $table = 'foto_barangs';

    protected $fillable = ['barang_id', 'foto'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

