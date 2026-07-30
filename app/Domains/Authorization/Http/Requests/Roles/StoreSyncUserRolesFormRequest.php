<?php

namespace App\Domains\Authorization\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class StoreSyncUserRolesFormRequest extends FormRequest
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

            'roles' => [
                'required',
                'array',
                'min:1',
            ],

            'roles.*' => [
                'required',
                'integer',
                'distinct',
                'exists:roles,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User is required.',
            'user_id.integer'  => 'User ID must be an integer.',
            'user_id.exists'   => 'The selected user does not exist.',

            'roles.required' => 'Roles are required.',
            'roles.array'    => 'Roles must be an array.',
            'roles.min'      => 'Select at least one role.',

            'roles.*.required' => 'Role ID is required.',
            'roles.*.integer'  => 'Role ID must be an integer.',
            'roles.*.distinct' => 'Duplicate roles are not allowed.',
            'roles.*.exists'   => 'One or more selected roles do not exist.',
        ];
    }
}
