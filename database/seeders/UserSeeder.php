<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin InovaMarket',
            'email' => 'admin@inovamarket.com',
            'password' => Hash::make('password'), // password: password
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        // Regular users
        User::create([
            'name' => 'User  Demo',
            'email' => 'user@inovamarket.com',
            'password' => Hash::make('password'), // password: password
            'role' => 'user',
            'phone' => '081234567891',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'), // password: password
            'role' => 'user',
            'phone' => '081234567892',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'), // password: password
            'role' => 'user',
            'phone' => '081234567893',
        ]);
    }
}
