<?php

namespace Database\Seeders;

use App\Models\Opd;
use Illuminate\Database\Seeder;

final class OpdSeeder extends Seeder
{
    public function run(): void
    {
        Opd::create(['kode' => '1.03.0.00.0.00.01', 'nama' => 'Dinas Pekerjaan Umum dan Penataan Ruang']);
    }
}
