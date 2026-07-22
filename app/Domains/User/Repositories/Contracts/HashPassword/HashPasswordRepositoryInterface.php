<?php

namespace App\Domains\USer\Repositories\Contracts\HashPassword;

interface HashPasswordRepositoryInterface
{
    public function hashPassword(string $password): string;
}