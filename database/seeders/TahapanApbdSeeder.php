<?php

namespace Database\Seeders;

use App\Models\TahapanApbd;
use Illuminate\Database\Seeder;

class TahapanApbdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TahapanApbd::create([
            'tahun' => 2022,
            'nama' => 'Murni',
            'nomor_dpa' => '123',
        ]);

        TahapanApbd::create([
            'tahun' => 2023,
            'nama' => 'Murni',
            'nomor_dpa' => '123',
        ]);

        TahapanApbd::create([
            'tahun' => 2024,
            'nama' => 'Murni',
            'nomor_dpa' => '123',
            'created_at' => now()->addMinute(1),
            'updated_at' => now()->addMinute(1),
        ]);
    }
}
