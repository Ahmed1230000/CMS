<?php

namespace App\Domains\Authorization\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class StoreSyncRolePermissionsFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role_id' => ['required', 'integer', 'exists:roles,id'],

            'permissions' => ['required', 'array', 'min:1'],

            'permissions.*' => [
                'integer',
                'distinct',
                'exists:permissions,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'role_id.required' => 'Role is required.',
            'role_id.exists' => 'Selected role does not exist.',

            'permissions.required' => 'Permissions are required.',
            'permissions.array' => 'Permissions must be an array.',
            'permissions.min' => 'Select at least one permission.',

            'permissions.*.exists' => 'One or more selected permissions are invalid.',
            'permissions.*.distinct' => 'Duplicate permissions are not allowed.',
        ];
    }
}
