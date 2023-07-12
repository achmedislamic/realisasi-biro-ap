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
        Upt::create(['nama' => 'Dinas Pekerjaan Umum dan Penataan Ruang']);
        Upt::create(['nama' => 'Balai Pengujian Material Konstruksi']);
        Upt::create(['nama' => 'Balai Pemeliharaan Jalan Provinsi Wilayah Pulau Lombok']);
        Upt::create(['nama' => 'Balai Pemeliharaan Jalan Provinsi Wilayah Pulau Sumbawa']);
        Upt::create(['nama' => 'Balai Pengelolaan Sumber Daya Air dan Hidrologi Wilayah Sungai Pulau Lombok']);
        Upt::create(['nama' => 'Balai Pengelolaan Sumber Daya Air dan Hidrologi Wilayah Sungai Pulau Sumbawa']);
        Upt::create(['nama' => 'Balai Pemeliharaan Jalan Provinsi Wilayah Pulau Sumbawa Bagian Timur']);
        Upt::create(['nama' => 'Balai Pengelolaan Sumber Daya Air dan Hidrologi Wilayah Sungai Pulau Sumbawa Bagian Timur']);
    }
}
