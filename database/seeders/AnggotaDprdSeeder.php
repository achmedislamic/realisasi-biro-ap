<?php

namespace Database\Seeders;

use App\Models\AnggotaDprd;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaDprdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnggotaDprd::create([
            'awal_periode' => 2023,
            'fraksi' => 'Demokrat',
            'nama' => 'Nama DPRD Demokrat'
        ]);
    }
}
