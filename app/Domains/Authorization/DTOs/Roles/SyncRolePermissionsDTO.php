<?php

namespace App\Domains\Authorization\DTOs\Roles;

class SyncRolePermissionsDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $roleId,
        public readonly array $permissionIds,
    ) {}

    public static function fromArray(array $data)
    {
        return new self(
            $data['role_id'],
            $data['permissions'],
        );
    }
}
