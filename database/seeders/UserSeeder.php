<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create 99 NEW CUSTOMER users
        for ($i = 0; $i < 99; $i++) {
            User::create([
                'name' => 'New Customer ' . ($i + 1),
                'email' => 'new_customer' . ($i + 1) . '@example.com',
                'password' => Hash::make('password'),
                'status' => 'NEW CUSTOMER',
            ]);
        }

        // Create 50 LOYAL CUSTOMER users
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'name' => 'Loyal Customer ' . ($i + 1),
                'email' => 'loyal_customer' . ($i + 1) . '@example.com',
                'password' => Hash::make('password'),
                'status' => 'LOYAL CUSTOMER',
            ]);
        }
    }
}