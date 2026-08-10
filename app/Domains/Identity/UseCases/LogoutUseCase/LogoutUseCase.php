<?php

namespace App\Domains\Identity\UseCases\LogoutUseCase;

use App\Domains\Identity\Service\CreateSessionService;
use App\Domains\Identity\Service\PassportTokenService;
use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;


class LogoutUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private UserRepositoryInterface $userRepositoryInterface,
        private PassportTokenService $passportTokenService,
        private CreateSessionService $sessionService

    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute($id = null): void
    {
        $this->sessionService->logout();
        // $model = $this->userRepositoryInterface->findById($id);
        // return $this->passportTokenService->logout($model);
    }
}
