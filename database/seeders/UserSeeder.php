<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $emailAdmin = 'admin@example.com';

        $user = User::create([
            'name' => 'Administrator',
            'email' => $emailAdmin,
            'password' => bcrypt($emailAdmin),
            'email_verified_at' => now(),
        ]);

        UserRole::create([
            'role_name' => 'admin',
            'user_id' => $user->id,
        ]);
    }
}
