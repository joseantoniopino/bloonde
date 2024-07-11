<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable'],
            'surname' => ['nullable'],
            'hobbies' => ['nullable', 'array'],
            'hobbies.*' => ['required', 'int', 'exists:hobbies,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
