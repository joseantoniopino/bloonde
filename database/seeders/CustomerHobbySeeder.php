<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerHobbySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customer_hobby')->insert([
            ['customer_id' => 1, 'hobby_id' => 1], // Asignando 'Reading' al primer cliente
            ['customer_id' => 1, 'hobby_id' => 2], // Asignando 'Swimming' al primer cliente
        ]);
    }
}
