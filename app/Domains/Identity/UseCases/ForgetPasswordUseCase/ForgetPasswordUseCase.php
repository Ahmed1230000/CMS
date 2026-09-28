<?php

namespace App\Domains\Identity\UseCases\ForgetPasswordUseCase;

use App\Domains\User\Repositories\Contracts\User\UserRepositoryInterface;
use App\Domains\Identity\DTOs\forgetPassword\ForgetPasswordDTO;
use App\Domains\Identity\DTOs\ForgetPassword\ResetPasswordDTO;
use App\Domains\Identity\Exceptions\ForgetPassword\UserEmailNotExistsException;
use App\Domains\Identity\Service\PasswordResetService;
use Exception;
use Illuminate\Support\Facades\Log;

class ForgetPasswordUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private UserRepositoryInterface $repository,
        protected PasswordResetService $passwordResetService,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(ForgetPasswordDTO $dto)
    {
        try {
            $user = $this->repository->findByEmail($dto->email->value());

            if (!$user) {
                return;
            }

            $this->passwordResetService->sendResetLink($user->email->value());
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function resetPassword(ResetPasswordDTO $dto): void
    {
        $this->passwordResetService->resetPassword($dto);
    }
}
