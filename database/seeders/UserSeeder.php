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
            'user_id' => $user->id,
            'imageable_type' => null,
        ]);

        UserRole::create([
            'user_id' => $userBidang->id,
            'imageable_id' => Bidang::firstWhere('nama', 'like', '%Cipta Karya%')->id,
            'imageable_type' => 'bidang',
        ]);

        UserRole::create([
            'user_id' => $userUpt->id,
            'imageable_id' => Upt::firstWhere('nama', 'like', '%Balai Pengujian Material Konstruksi%')->id,
            'imageable_type' => 'upt',
        ]);
    }
}
