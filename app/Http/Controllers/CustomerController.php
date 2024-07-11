<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetCustomersByHobbyRequest;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

// TODO: Implement resources and custom json responses
class CustomerController extends Controller
{
    public function index()
    {
        return Customer::with('hobbies')->get();
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $customer = Customer::create($request->only(['name', 'surname', 'user_id']));

        if ($request->has('hobbies')) {
            $customer->hobbies()->sync($request->hobbies);
        }

        return response()->json($customer->load('hobbies'), 201);
    }

    public function show(Customer $customer): JsonResponse
    {
        return response()->json($customer->load('hobbies'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        $customer->update($request->only(['name', 'surname']));

        if ($request->has('hobbies')) {
            $customer->hobbies()->sync($request->hobbies);
        }

        return response()->json($customer->load('hobbies'));
    }

    public function destroy(Customer $customer): JsonResponse
    {
        $customer->delete();

        return response()->json(null, 204);
    }

    public function getCustomersByHobby(GetCustomersByHobbyRequest $request): JsonResponse
    {
        $hobbyId = $request->hobby_id;
        $customerNames = Customer::withWhereHas('hobbies', function($query) use ($hobbyId) {
            $query->where('hobby_id', $hobbyId);
        })->pluck('name');

        return response()->json($customerNames);
    }
}
