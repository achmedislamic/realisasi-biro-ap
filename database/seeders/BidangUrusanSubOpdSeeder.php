<?php

namespace Database\Seeders;

use App\Models\BidangUrusanSubOpd;
use Illuminate\Database\Seeder;

class BidangUrusanSubOpdSeeder extends Seeder
{
    public function run(): void
    {
        BidangUrusanSubOpd::create(['bidang_urusan_id' => 1, 'sub_opd_id' => 1]);
    }
}
