<?php

namespace App\Domains\Identity\DTOs\Login;

use App\Common\ValueObjectSystem\EmailVO;
use App\Common\ValueObjectSystem\PasswordVO;

class LoginDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        
        public readonly EmailVO $email,
        public readonly PasswordVO $password
    ) {}

    public static function from(array $data): self
    {
        return new self(
            email: EmailVO::from($data['email']),
            password: PasswordVO::from($data['password'])
        );
    }
}
