<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Parkiran',
                'password' => 'password123',
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas@gmail.com'],
            [
                'name' => 'Petugas Parkiran',
                'password' => 'password123',
                'role' => 'petugas'
            ]
        );

        User::updateOrCreate(
            ['email' => 'owner@gmail.com'],
            [
                'name' => 'Owner Parkiran',
                'password' => 'password123',
                'role' => 'owner'
            ]
        );
    }
}