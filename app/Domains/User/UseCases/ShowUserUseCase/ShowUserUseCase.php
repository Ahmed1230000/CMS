<?php

namespace App\Domains\User\UseCases\ShowUserUseCase;

use App\Domains\User\DTOs\User\ShowUserDTO;
use App\Domains\User\Exceptions\User\UserNotFoundException;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;


class ShowUserUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private UserRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $id): ShowUserDTO
    {
        $user = $this->repository->findById($id);

        if (!$user) {
            throw new UserNotFoundException('User not found.');
        }
        return ShowUserDTO::fromEntity($user);
    }
}
