<?php

namespace Database\Seeders;

use App\Models\TahapanApbd;
use Illuminate\Database\Seeder;

class TahapanApbdSeeder extends Seeder
{
    public function run(): void
    {
        TahapanApbd::create([
            'tahun' => 2023,
            'nama' => 'Murni',
            'nomor_dpa' => '123',
        ]);
    }
}
