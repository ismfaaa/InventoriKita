<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Stakeholder
        User::create([
            'name' => 'Stakeholder',
            'email' => 'stakeholder@test.com',
            'password' => Hash::make('password'),
            'role' => 'stakeholder',
        ]);
    }
}