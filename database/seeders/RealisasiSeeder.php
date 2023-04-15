<?php

namespace Database\Seeders;

use App\Models\Realisasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RealisasiSeeder extends Seeder
{
    public function run(): void
    {
        Realisasi::truncate();

        Realisasi::factory()->count(500)->create([
            'tanggal' => now()->addYear()->startOfYear()
        ]);

        Realisasi::factory()->count(500)->create([
            'tanggal' => now()->addYear()
        ]);
    }
}
