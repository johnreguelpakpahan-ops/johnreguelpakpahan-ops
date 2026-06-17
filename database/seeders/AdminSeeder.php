<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah sudah ada, jika belum buat
        Admin::firstOrCreate(
            ['email' => 'tuktukambaritatomokgeosite@gmail.com'],
            [
                'name' => 'Admin GeoToba',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}