<?php

namespace App\Domains\Identity\UseCases\RegisterUseCase;

use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;
use App\Domains\Identity\DTOs\Register\RegisterDTO;
use App\Domains\Identity\Exceptions\Login\InvalidCredentialsException;
use App\Domains\User\DTOs\User\UserDTO;
use App\Domains\User\Entities\User\UserEntity;
use App\Domains\USer\Repositories\Contracts\HashPassword\HashPasswordRepositoryInterface;

class RegisterUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private UserRepositoryInterface $repository,
        private HashPasswordRepositoryInterface $passwordHasher
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(RegisterDTO $dto): UserEntity
    {
        $findEmail = $this->repository->findByEmail($dto->email->value());

        if ($findEmail) {
            throw new InvalidCredentialsException(
                'The email is already registered.'
            );
        }

        $hashedPassword = $this->passwordHasher->hashPassword($dto->password);

        $user = UserEntity::register(
            $dto->name,
            $dto->email,
            $hashedPassword,
        );

        return $this->repository->create($user);
    }
}
