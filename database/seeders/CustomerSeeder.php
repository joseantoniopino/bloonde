<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Hobby;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $userCustomer = User::where('email', 'customer@example.com')->first();

        $customer = Customer::create([
            'name' => 'John',
            'surname' => 'Doe',
            'user_id' => $userCustomer->id,
        ]);

        $hobbies = Hobby::whereIn('name', ['Reading', 'Swimming', 'Cycling'])->get();

        $customer->hobbies()->sync($hobbies->pluck('id')->toArray());
    }
}
