<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\Upt;
use App\Models\{User, UserRole};
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $emailAdmin = 'admin@example.com';
        $emailBidang = 'bidang@example.com';
        $emailUpt = 'upt@example.com';

        $user = User::create([
            'name' => 'Administrator',
            'email' => $emailAdmin,
            'password' => bcrypt($emailAdmin),
            'email_verified_at' => now(),
        ]);

        $userBidang = User::create([
            'name' => 'Cipta Karya',
            'email' => $emailBidang,
            'password' => bcrypt($emailBidang),
            'email_verified_at' => now(),
        ]);

        $userUpt = User::create([
            'name' => 'UPT',
            'email' => $emailUpt,
            'password' => bcrypt($emailUpt),
            'email_verified_at' => now(),
        ]);

        UserRole::create([
            'role_name' => 'admin',
            'user_id' => $user->id,
        ]);

        UserRole::create([
            'role_name' => 'bidang',
            'user_id' => $userBidang->id,
            'imageable_id' => Bidang::firstWhere('nama', 'like', '%Cipta Karya%')->id,
            'imageable_type' => 'bidang',
        ]);

        UserRole::create([
            'role_name' => 'upt',
            'user_id' => $userUpt->id,
            'imageable_id' => Upt::firstWhere('nama', 'like', '%Balai Pengujian Material Konstruksi%')->id,
            'imageable_type' => 'upt',
        ]);
    }
}
