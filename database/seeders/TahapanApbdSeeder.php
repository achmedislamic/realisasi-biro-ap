<?php

namespace Database\Seeders;

use App\Models\TahapanApbd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'tahun' => 2023,
            'nama' => 'Murni',
            'nomor_dpa' => '123'
        ]);
    }
}
