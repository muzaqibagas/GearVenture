<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'jenis_kelamin',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
