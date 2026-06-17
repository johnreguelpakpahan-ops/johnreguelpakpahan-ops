<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeositeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('geosite')->insert([

    ['nama' => 'Tuktuk ',       'admin_id' => 1, 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Ambarita',      'admin_id' => 1, 'created_at' => now(), 'updated_at' => now()],
    ['nama' => 'Tomok ',        'admin_id' => 1, 'created_at' => now(), 'updated_at' => now()],

        ]);
    }
}