<?php

namespace Database\Seeders;

use App\Models\RincianMasalah;
use Illuminate\Database\Seeder;

class RincianMasalahSeeder extends Seeder
{
    public function run(): void
    {
        RincianMasalah::truncate();

        RincianMasalah::factory()->count(50)->create();
    }
}
