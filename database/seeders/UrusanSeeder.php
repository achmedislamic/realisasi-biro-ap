<?php

namespace Database\Seeders;

use App\Models\Urusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UrusanSeeder extends Seeder
{
    public function run(): void
    {
        Urusan::create(['kode' => 1, 'nama' => 'URUSAN PEMERINTAHAN WAJIB YANG BERKAITAN DENGAN PELAYANAN DASAR']);
    }
}
