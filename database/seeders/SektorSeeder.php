<?php

namespace Database\Seeders;

use App\Models\Sektor;
use Illuminate\Database\Seeder;

class SektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sektor::create(['nama' => 'Infrastruktur']);
        Sektor::create(['nama' => 'Sosbud']);
        Sektor::create(['nama' => 'Ekonomi']);
    }
}
