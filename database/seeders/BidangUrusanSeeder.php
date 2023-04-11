<?php

namespace Database\Seeders;

use App\Models\BidangUrusan;
use Illuminate\Database\Seeder;

class BidangUrusanSeeder extends Seeder
{
    public function run(): void
    {
        BidangUrusan::create(['urusan_id' => 1, 'kode' => '01', 'nama' => 'URUSAN PEMERINTAHAN BIDANG PENDIDIKAN']);
    }
}
