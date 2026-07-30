<?php

namespace App\Domains\Authorization\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class StoreSyncUserPermissionsFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'permissions' => [
                'required',
                'array',
                'min:1',
            ],

            'permissions.*' => [
                'required',
                'integer',
                'distinct',
                'exists:permissions,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User is required.',
            'user_id.integer'  => 'User ID must be an integer.',
            'user_id.exists'   => 'The selected user does not exist.',

            'permissions.required' => 'Permissions are required.',
            'permissions.array'    => 'Permissions must be an array.',
            'permissions.min'      => 'Select at least one permission.',

            'permissions.*.required' => 'Permission ID is required.',
            'permissions.*.integer'  => 'Permission ID must be an integer.',
            'permissions.*.distinct' => 'Duplicate permissions are not allowed.',
            'permissions.*.exists'   => 'One or more selected permissions do not exist.',
        ];
    }
}
