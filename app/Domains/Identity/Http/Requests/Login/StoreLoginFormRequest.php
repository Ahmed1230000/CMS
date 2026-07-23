<?php

namespace App\Domains\Identity\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required.',
            'email.email'    => 'Please enter a valid email address.',
            'email.max'      => 'Email must not exceed 255 characters.',

            'password.required' => 'Password is required.',
            'password.string'   => 'Password must be a valid string.',
            'password.min'      => 'Password must be at least 8 characters.',
        ];
    }
}
