<?php

namespace App\Domains\USer\Repositories\Eloquent\HashPassword;

use App\Domains\USer\Repositories\Contracts\HashPassword\HashPasswordRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class HashPasswordEloquentRepository implements HashPasswordRepositoryInterface
{
    public function hashPassword(string $password): string
    {
        return Hash::make($password);
    }
}
