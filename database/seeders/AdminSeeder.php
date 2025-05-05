<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'nama' => 'Admin GearVenture',
            'username' => 'admingearventure',
            'email' => 'admin@gearventure.com',
            'foto' => '',
            'password' => Hash::make('adminpassword'),
            'jenis_kelamin' => 'Laki-laki',
            'role' => 'admin'
        ]);
        User::create([
            'nama' => 'Ali Imron',
            'username' => 'Ali',
            'email' => 'Ali@gmail.com',
            'foto' => '',
            'password' => Hash::make('ali12345'),
            'jenis_kelamin' => 'Laki-laki',
            'role' => 'user'
        ]);
    }
}
