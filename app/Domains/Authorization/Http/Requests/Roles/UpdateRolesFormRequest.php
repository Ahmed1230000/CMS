<?php

namespace App\Domains\Authorization\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRolesFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // TODO: define validation rules

            'name' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            // TODO: custom validation messages

            'name.required' => 'Role name is required.',
            'name.string' => 'Role name must be a string.',
            'name.max' => 'Role name may not be greater than 255 characters.',
            'name.unique' => 'This role already exists for the selected guard.',
        ];
    }
}
