<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'user_id' => 'required|exists:users,id',
            'hobbies' => 'nullable|array',
            'hobbies.*' => 'required|int|exists:hobbies,id',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
