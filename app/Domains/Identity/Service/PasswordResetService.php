<?php

namespace App\Domains\Identity\Service;

use App\Domains\Identity\DTOs\ForgetPassword\ResetPasswordDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;


class PasswordResetService
{
    public function sendResetLink(string $email)
    {
        return Password::sendResetLink(
            [
                'email' => $email,
            ]
        );
    }


    public function resetPassword(ResetPasswordDTO $dto): string
    {
        return Password::reset(
            [
                'email' => $dto->email->value(),
                'password' => $dto->password,
                'password_confirmation' => $dto->passwordConfirmation,
                'token' => $dto->token,
            ],
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password->value(),
                ]);

                $user->save();
            }
        );
    }
}
