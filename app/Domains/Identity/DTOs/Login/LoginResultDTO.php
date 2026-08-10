<?php

namespace App\Domains\Identity\DTOs\Login;

use App\Domains\User\Entities\User\UserEntity;

class LoginResultDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly string $token,
        public UserEntity $user,
    ) {}
}
