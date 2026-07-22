<?php

namespace App\Domains\User\Repositories\Contracts\User;

use App\Domains\User\DTOs\User\UserDTO;
use App\Domains\User\Entities\User\UserEntity;

interface UserRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */


    public function create(UserDTO $userDTO): UserEntity;
}
