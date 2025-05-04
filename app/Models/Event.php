<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'event'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key

    protected $fillable = [
        'gambar',
        'judul',
        'lokasi',
        'isi_artikel',
    ];

    public function fotoBarangs()
    {
        return $this->hasMany(FotoBarang::class, 'id');
    }
}
