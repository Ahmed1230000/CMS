<?php

namespace App\Domains\User\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // TODO: define validation rules
        ];
    }

    public function messages(): array
    {
        return [
            // TODO: custom validation messages
        ];
    }
}