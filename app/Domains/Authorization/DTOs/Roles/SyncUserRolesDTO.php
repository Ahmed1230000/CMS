<?php

namespace App\Domains\Authorization\DTOs\Roles;

class SyncUserRolesDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $userId,
        public readonly array $roleIds,
    ) {}


    public static function fromArray(array $data)
    {
        return new self(
            $data['user_id'],
            $data['roles'],
        );
    }
}
