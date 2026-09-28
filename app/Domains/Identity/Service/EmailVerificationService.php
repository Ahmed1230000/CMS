<?php

namespace App\Domains\Identity\Service;

use App\Models\User;

class EmailVerificationService
{
    public function resend(User $user)
    {
        if ($user->hasVerifiedEmail()) {
            return;
        }
        $user->sendEmailVerificationNotification();
    }
}
