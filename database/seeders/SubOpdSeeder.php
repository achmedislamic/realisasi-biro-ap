<?php

namespace Database\Seeders;

use App\Models\SubOpd;
use Illuminate\Database\Seeder;

class SubOpdSeeder extends Seeder
{
    public function run(): void
    {
        SubOpd::create(['kode' => '0000', 'opd_id' => 1, 'nama' => 'Dinas Pekerjaan Umum dan Penataan Ruang']);
        SubOpd::create(['kode' => '0005', 'opd_id' => 1, 'nama' => 'Balai Pengujian Material Konstruksi']);
        SubOpd::create(['kode' => '0001', 'opd_id' => 1, 'nama' => 'Balai Pemeliharaan Jalan Provinsi Wilayah Pulau Lombok']);
        SubOpd::create(['kode' => '0002', 'opd_id' => 1, 'nama' => 'Balai Pemeliharaan Jalan Provinsi Wilayah Pulau Sumbawa']);
        SubOpd::create(['kode' => '0003', 'opd_id' => 1, 'nama' => 'Balai Pengelolaan Sumber Daya Air dan Hidrologi Wilayah Sungai Pulau Lombok']);
        SubOpd::create(['kode' => '0004', 'opd_id' => 1, 'nama' => 'Balai Pengelolaan Sumber Daya Air dan Hidrologi Wilayah Sungai Pulau Sumbawa']);
        SubOpd::create(['kode' => '0006', 'opd_id' => 1, 'nama' => 'Balai Pemeliharaan Jalan Provinsi Wilayah Pulau Sumbawa Bagian Timur']);
        SubOpd::create(['kode' => '0007', 'opd_id' => 1, 'nama' => 'Balai Pengelolaan Sumber Daya Air dan Hidrologi Wilayah Sungai Pulau Sumbawa Bagian Timur']);
    }
}
