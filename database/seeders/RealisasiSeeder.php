<?php

namespace Database\Seeders;

use App\Models\Realisasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RealisasiSeeder extends Seeder
{
    public function run(): void
    {
        Realisasi::create([
            'objek_realisasi_id' => 2,
            'tanggal' => now()->addYear(1)->startOfYear()->toDateString(),
            'jumlah' => 1000
        ]);

        Realisasi::create([
            'objek_realisasi_id' => 3,
            'tanggal' => now()->addYear(1)->startOfYear()->toDateString(),
            'jumlah' => 2000
        ]);

        Realisasi::create([
            'objek_realisasi_id' => 4,
            'tanggal' => now()->addYear(1)->startOfYear()->toDateString(),
            'jumlah' => 4000
        ]);
    }
}
