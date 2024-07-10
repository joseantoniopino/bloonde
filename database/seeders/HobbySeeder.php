<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;

class HobbySeeder extends Seeder
{
    public function run(): void
    {
        Hobby::create(['name' => 'Reading']);
        Hobby::create(['name' => 'Swimming']);
        Hobby::create(['name' => 'Cycling']);
    }
}
