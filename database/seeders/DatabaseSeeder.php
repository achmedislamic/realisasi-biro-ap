<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BidangSeeder::class,
            SektorSeeder::class,
            SatuanSeeder::class,
            UrusanSeeder::class,
            BidangUrusanSeeder::class,
            OpdSeeder::class,
            SubOpdSeeder::class,
            BidangUrusanSubOpdSeeder::class,
            UserSeeder::class,
            TahapanApbdSeeder::class,
        ]);
    }
}
