<?php

namespace App\Domains\Identity\UseCases\SendVerificationEmailUseCase;

use App\Domains\Identity\Service\EmailVerificationService;
use App\Models\User;

class SendVerificationEmailUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        protected EmailVerificationService $emailVerificationService,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(User $user): void
    {
        $this->emailVerificationService->resend($user);
    }
}
