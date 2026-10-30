<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['nama' => 'Nadia Putri', 'email' => 'admin@ruangkarya.com', 'password' => Hash::make('password123'), 'role' => 'admin', 'username' => 'admin', 'status_akun' => 'aktif']);
        User::create(['nama' => 'Kreator Seni', 'email' => 'kreator@ruangkarya.com', 'password' => Hash::make('password123'), 'role' => 'kreator', 'username' => 'kreator1', 'status_akun' => 'aktif']);
        User::create(['nama' => 'Pengunjung Setia', 'email' => 'pengunjung@ruangkarya.com', 'password' => Hash::make('password123'), 'role' => 'pengunjung', 'username' => 'pengunjung1', 'status_akun' => 'aktif']);
    }
}