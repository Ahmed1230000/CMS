<?php

namespace App\Domains\User\UseCases\User;

use App\Domains\User\DTOs\User\UserDTO;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;

class UpdateUserUseCase
{
    public function __construct(
        protected UserRepositoryInterface $repository
    ) {}

    public function execute(UserDTO $dto): UserDTO
    {
        // TODO: implement business logic
        $this->repository;

        return $dto;
    }
}