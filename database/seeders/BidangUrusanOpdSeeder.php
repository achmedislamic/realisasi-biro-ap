<?php

namespace Database\Seeders;

use App\Models\{BidangUrusan, BidangUrusanOpd, Opd};
use Illuminate\Database\Seeder;

class BidangUrusanOpdSeeder extends Seeder
{
    public function run(): void
    {
        BidangUrusanOpd::create(['bidang_urusan_id' => 1, 'opd_id' => 1]);
    }
}
