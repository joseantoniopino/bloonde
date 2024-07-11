<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::with('hobbies')->get();
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->only(['name', 'surname', 'user_id']));

        if ($request->has('hobbies')) {
            $customer->hobbies()->sync($request->hobbies);
        }

        return response()->json($customer->load('hobbies'), 201);
    }

    public function show(Customer $customer)
    {
        return response()->json($customer->load('hobbies'));
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->only(['name', 'surname']));

        if ($request->has('hobbies')) {
            $customer->hobbies()->sync($request->hobbies);
        }

        return response()->json($customer->load('hobbies'));
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(null, 204);
    }

    public function getCustomersByHobby($hobby_id)
    {
        $customers = Customer::whereHas('hobbies', function($query) use ($hobby_id) {
            $query->where('hobby_id', $hobby_id);
        })->get();

        return response()->json($customers);
    }
}
