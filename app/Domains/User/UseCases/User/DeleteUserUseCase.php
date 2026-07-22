<?php

namespace App\Domains\User\UseCases\User;

use App\Domains\User\DTOs\User\UserDTO;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;

class DeleteUserUseCase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}