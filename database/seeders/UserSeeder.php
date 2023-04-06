<?php

namespace Database\Seeders;

use App\Models\{Opd, SubOpd};
use App\Models\{User, UserRole};
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $emailAdmin = 'admin@example.com';
        $emailDikbud = 'dikbud@example.com';
        $emailSubOpd = 'sub_opd_dikbud@example.com';

        $user = User::create([
            'name' => 'Administrator',
            'email' => $emailAdmin,
            'password' => bcrypt($emailAdmin),
            'email_verified_at' => now(),
        ]);

        $userOpd = User::create([
            'name' => 'Dikbud',
            'email' => $emailDikbud,
            'password' => bcrypt($emailDikbud),
            'email_verified_at' => now(),
        ]);

        $userSubOpd = User::create([
            'name' => 'Sub OPD Dikbud',
            'email' => $emailSubOpd,
            'password' => bcrypt($emailSubOpd),
            'email_verified_at' => now(),
        ]);

        UserRole::create([
            'role_name' => 'admin',
            'user_id' => $user->id,
        ]);

        UserRole::create([
            'role_name' => 'opd',
            'user_id' => $userOpd->id,
            'imageable_id' => Opd::firstWhere('nama', 'like', '%dinas pendidikan%')->id,
            'imageable_type' => 'App\Models\Opd',
        ]);

        UserRole::create([
            'role_name' => 'sub_opd',
            'user_id' => $userSubOpd->id,
            'imageable_id' => SubOpd::firstWhere('nama', 'like', '%dinas pendidikan%')->id,
            'imageable_type' => 'App\Models\SubOpd',
        ]);
    }
}
