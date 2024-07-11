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
        // Crear un usuario específico y su cliente asociado
        $userCustomer = User::where('email', 'customer@example.com')->first();

        $customer = Customer::create([
            'name' => 'John',
            'surname' => 'Doe',
            'user_id' => $userCustomer->id,
        ]);

        $hobbies = Hobby::factory()->count(10)->create();

        $customer->hobbies()->sync($hobbies->pluck('id')->toArray());

        // Crear 50 clientes aleatorios
        Customer::factory(50)->create()->each(function (Customer $customer) {
            // Obtener un usuario con el perfil de cliente
            $user = User::factory()->create(['profile_id' => 2]);

            // Asignar el usuario al cliente
            $customer->user_id = $user->id;
            $customer->save();

            // Asignar hobbies aleatorios al cliente
            $randomHobbies = Hobby::inRandomOrder()->take(rand(1, 3))->pluck('id')->toArray();
            $customer->hobbies()->sync($randomHobbies);
        });
    }
}
