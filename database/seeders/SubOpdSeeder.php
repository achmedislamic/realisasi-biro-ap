<?php

namespace Database\Seeders;

use App\Models\SubOpd;
use Illuminate\Database\Seeder;

class SubOpdSeeder extends Seeder
{
    public function run(): void
    {
        SubOpd::create(['kode' => '0006', 'nama' => 'Cabang Dinas Pendidikan dan Kebudayaan Sumbawa', 'opd_id' => 1]);
    }
}
