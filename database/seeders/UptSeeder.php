<?php

namespace Database\Seeders;

use App\Models\Upt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Upt::create(['nama' => 'Balai Pengujian Material Konstruksi']);
    }
}
