<?php

namespace App\Domains\Authorization\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolesFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Rule::unique('roles')->where(fn($query) => $query->where(
                //     'guard_name',
                //     $this->input('guard_name')
                // )),
                'unique:roles,name'
            ],

            // 'guard_name' => [
            //     'required',
            //     'string',
            //     'max:255',
            // ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Role name is required.',
            'name.string' => 'Role name must be a string.',
            'name.max' => 'Role name may not be greater than 255 characters.',
            'name.unique' => 'This role already exists for the selected guard.',

            // 'guard_name.required' => 'Guard name is required.',
            // 'guard_name.string' => 'Guard name must be a string.',
            // 'guard_name.max' => 'Guard name may not be greater than 255 characters.',
        ];
    }
}
