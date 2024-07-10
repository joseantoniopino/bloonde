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
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'profile_id' => 1,
            'status_id' => 1,
        ]);

        User::create([
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'profile_id' => 2,
            'status_id' => 1,
        ]);
    }
}
