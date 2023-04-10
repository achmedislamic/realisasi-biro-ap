<?php

namespace Database\Seeders;

use App\Models\BidangUrusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangUrusanSeeder extends Seeder
{
    public function run(): void
    {
        BidangUrusan::create(['urusan_id' => 1, 'kode' => '1.01', 'nama' => 'URUSAN PEMERINTAHAN BIDANG PENDIDIKAN']);
    }
}
