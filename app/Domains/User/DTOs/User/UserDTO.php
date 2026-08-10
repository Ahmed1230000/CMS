<?php

namespace App\Domains\User\DTOs\User;

use App\Common\ValueObjectSystem\EmailVO;
use App\Common\ValueObjectSystem\PasswordVO;

class UserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly EmailVO $email,
        public readonly PasswordVO $password
    ) {}
}
