<?php

namespace App\Domains\User\Repositories\Eloquent\HashPassword;

use App\Common\ValueObjectSystem\PasswordVO;
use App\Domains\User\Repositories\Contracts\HashPassword\HashPasswordRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class HashPasswordEloquentRepository implements HashPasswordRepositoryInterface
{
    public function hashPassword(PasswordVO $password): PasswordVO
    {
        return PasswordVO::from(Hash::make($password->value()));
    }

    public function verifyPassword(string $password, string $hashedPassword): bool
    {
        return Hash::check($password, $hashedPassword);
    }
}
