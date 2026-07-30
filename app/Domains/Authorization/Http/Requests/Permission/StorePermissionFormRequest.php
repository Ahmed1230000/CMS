<?php

namespace App\Domains\Authorization\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionFormRequest extends FormRequest
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
                'unique:permissions,name',
            ],

            // 'guard_name' => [
            //     'nullable',
            //     'string',
            //     'max:255',
            // ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'Permission name is required.',
            'name.string'     => 'Permission name must be a string.',
            'name.max'        => 'Permission name may not be greater than 255 characters.',
            'name.unique'     => 'Permission already exists.',

            // 'guard_name.string' => 'Guard name must be a string.',
            // 'guard_name.max'    => 'Guard name may not be greater than 255 characters.',
        ];
    }
}
