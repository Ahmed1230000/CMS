<?php

namespace App\Domains\Identity\DTOs\Register;

use App\Common\ValueObjectSystem\EmailVO;
use App\Common\ValueObjectSystem\PasswordVO;

class RegisterDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly string $name,
        public readonly EmailVO $email,
        public readonly PasswordVO $password
    ) {}


    public static function from(array $data): self
    {
        return new self(
            name: $data['name'],
            email: EmailVO::from($data['email']),
            password: PasswordVO::from($data['password']),
        );
    }
}
