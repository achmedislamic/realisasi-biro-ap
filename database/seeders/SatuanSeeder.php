<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Satuan::create(['nama' => 'unit']);
        Satuan::create(['nama' => 'paket']);
        Satuan::create(['nama' => 'km']);
        Satuan::create(['nama' => 'meter']);
        Satuan::create(['nama' => 'liter']);
    }
}
