<?php

namespace App\Domains\Identity\UseCases\LoginUseCase;

use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;
use App\Domains\Identity\DTOs\Login\LoginDTO;
use App\Domains\Identity\DTOs\Login\LoginResultDTO;
use App\Domains\Identity\Exceptions\Login\InvalidCredentialsException;
use App\Domains\Identity\Service\CreateSessionService;
use App\Domains\Identity\Service\PassportTokenService;
use App\Domains\USer\Repositories\Contracts\HashPassword\HashPasswordRepositoryInterface;

class LoginUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private UserRepositoryInterface $repository,
        private HashPasswordRepositoryInterface $hashPasswordRepository,
        private PassportTokenService $passportTokenService,
        private CreateSessionService $createSessionService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(LoginDTO $dto): void
    {
        $findEmail = $this->repository->findByEmail($dto->email->value());

        if (!$findEmail) {
            throw new InvalidCredentialsException('The email or password you entered is incorrect.');
        }

        if (!$this->hashPasswordRepository->verifyPassword($dto->password->value(), $findEmail->password->value())) {
            throw new InvalidCredentialsException('The email or password you entered is incorrect.');
        }

        $this->createSessionService->login($findEmail);

        // $token = $this->passportTokenService->createToken($findEmail);


        // return new LoginResultDTO(
        //     token: $token,
        //     user: $findEmail
        // );
    }
}
