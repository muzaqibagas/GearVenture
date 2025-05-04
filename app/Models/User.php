<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Nama tabel di database
    protected $primaryKey = 'id'; // Ubah primary key agar sesuai dengan database
    public $incrementing = true; // Primary key auto-increment
    protected $keyType = 'int'; // Tipe data primary key

    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'jenis_kelamin',
        'role',
        'foto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function keranjang()
    {
        return $this->hasOne(Keranjang::class, 'user_id');
    }
}
