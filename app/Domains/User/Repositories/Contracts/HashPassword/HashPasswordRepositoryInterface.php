<?php

namespace App\Domains\USer\Repositories\Contracts\HashPassword;

use App\Common\ValueObjectSystem\PasswordVO;

interface HashPasswordRepositoryInterface
{
    public function hashPassword(PasswordVO $password): PasswordVO;

    public function verifyPassword(string $password, string $hashedPassword): bool;
}
