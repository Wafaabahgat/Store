<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'phone_number'=>'1234567890',
        ]);
        User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'phone_number'=>'1234567890',
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'phone_number'=>'1234567890',
        ]);
        User::create([
            'name' => 'wafaa',
            'email' => 'wafaa@example.com',
            'password' => Hash::make('password'),
            'phone_number'=>'1234567890',
        ]);

    }
}