<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminProfile = Profile::where('name', 'admin')->first();
        $customerProfile = Profile::where('name', 'customer')->first();

        $statusActive = Status::where('name', 'active')->first();

        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'profile_id' => $adminProfile->id,
            'status_id' => $statusActive->id,
        ]);

        User::create([
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'profile_id' => $customerProfile->id,
            'status_id' => $statusActive->id,
        ]);
    }
}
