<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->syncRoles(['Super Admin']);

        // 2. Manager
        $manager = User::firstOrCreate(
            ['email' => 'manager@example.com'],
            [
                'name' => 'Operations Manager',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $manager->syncRoles(['Manager']);

        // 3. Regular User
        $regularUser = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Standard User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $regularUser->syncRoles(['User']);
    }
}
