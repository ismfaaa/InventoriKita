<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'role' => 'pengguna',
                'password' => Hash::make('user1234'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Stakeholder',
                'email' => 'stakeholder@gmail.com',
                'role' => 'stakeholder',
                'password' => Hash::make('stakeholder123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        User::insert($users);
    }
}
