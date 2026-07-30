<?php

namespace App\Domains\Authorization\DTOs\Permission;

class SyncUserPermissionsDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $userId,
        public readonly array $permissionIds,
    ) {}

    public static function fromArray(array $data)
    {
        return new self(
            $data['user_id'],
            $data['permissions']
        );
    }
}
