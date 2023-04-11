<?php

namespace Database\Seeders;

use App\Models\Opd;
use Illuminate\Database\Seeder;

class OpdSeeder extends Seeder
{
    public function run(): void
    {
        Opd::create(['kode' => '1.01.2.22.0.00.02', 'nama' => 'Dinas Pendidikan dan Kebudayaan']);
    }
}
