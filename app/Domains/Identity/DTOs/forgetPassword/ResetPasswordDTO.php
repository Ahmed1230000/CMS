<?php

namespace App\Domains\Identity\DTOs\ForgetPassword;

use App\Common\ValueObjectSystem\EmailVO;
use App\Common\ValueObjectSystem\PasswordVO;

class ResetPasswordDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly EmailVO $email,
        public readonly string $token,
        public readonly PasswordVO $password,
        public readonly string $passwordConfirmation,
    ) {}


    public static function fromArray(array $data)
    {
        return new self(
            email: EmailVO::from($data['email']),
            token: $data['token'],
            password: PasswordVO::from($data['password']),
            passwordConfirmation: $data['password_confirmation'],
        );
    }
}
