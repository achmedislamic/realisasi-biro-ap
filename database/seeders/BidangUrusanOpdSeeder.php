<?php

namespace Database\Seeders;

use App\Models\BidangUrusan;
use App\Models\BidangUrusanOpd;
use App\Models\Opd;
use Illuminate\Database\Seeder;

class BidangUrusanOpdSeeder extends Seeder
{
    public function run(): void
    {
        BidangUrusanOpd::truncate();

        foreach (BidangUrusan::all() as $bu) {
            $opds = Opd::inRandomOrder()->take(rand(1, 2))->pluck('id');
            $bu->opds()->attach($opds);
        }
    }
}
