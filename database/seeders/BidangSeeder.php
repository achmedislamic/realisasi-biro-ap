<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bidang::create(['nama' => 'Sekretaris']);
        Bidang::create(['nama' => 'Bina Konstruksi']);
        Bidang::create(['nama' => 'Bina Marga']);
        Bidang::create(['nama' => 'Sumber Daya Air']);
        Bidang::create(['nama' => 'Cipta Karya']);
        Bidang::create(['nama' => 'Pengembangan Pemukiman']);
        Bidang::create(['nama' => 'Bidang Tata Ruang']);
    }
}
