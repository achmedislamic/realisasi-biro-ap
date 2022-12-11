<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $emailAdmin = 'admin@example.com';

        User::create([
            'name' => 'Administrator',
            'email' => $emailAdmin,
            'password' => bcrypt($emailAdmin),
            'email_verified_at' => now()
        ]);
    }
}
