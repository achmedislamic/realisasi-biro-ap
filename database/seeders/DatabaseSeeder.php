<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UrusanSeeder::class,
            BidangUrusanSeeder::class,
            OpdSeeder::class,
            BidangUrusanOpdSeeder::class,
            SubOpdSeeder::class,
            UserSeeder::class,
            TahapanApbdSeeder::class,
        ]);
    }
}
