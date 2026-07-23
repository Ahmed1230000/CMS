<?php

namespace App\Domains\Identity\UseCases\LogoutUseCase;

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
        private PassportTokenService $passportTokenService
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $id)
    {
        $model = $this->userRepositoryInterface->findById($id);
        return $this->passportTokenService->logout($model);
    }
}
