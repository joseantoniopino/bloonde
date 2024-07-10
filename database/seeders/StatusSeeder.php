<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        Status::create(['name' => 'active']);
        Status::create(['name' => 'inactive']);
    }
}
