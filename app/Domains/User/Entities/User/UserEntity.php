<?php

namespace App\Domains\User\Entities\User;

use App\Common\ValueObjectSystem\EmailVO;
use App\Common\ValueObjectSystem\PasswordVO;

class UserEntity
{
    private function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly EmailVO $email,
        public readonly ?string $email_verified_at,
        public readonly PasswordVO $password,
        public readonly ?string $remember_token,
        public readonly \DateTimeImmutable $created_at,
        public readonly \DateTimeImmutable $updated_at
    ) {}

    public static function reconstitute(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            EmailVO::from($data['email']),
            $data['email_verified_at'] ?? null,
            PasswordVO::from($data['password']),
            $data['remember_token'] ?? null,
            new \DateTimeImmutable($data['created_at']),
            new \DateTimeImmutable($data['updated_at'])
        );
    }

    public static function register(
        string $name,
        EmailVO $email,
        PasswordVO $password,
    ): self {
        $now = new \DateTimeImmutable();

        return new self(
            id: null,
            name: $name,
            email: $email,
            email_verified_at: null,
            password: $password,
            remember_token: null,
            created_at: $now,
            updated_at: $now,
        );
    }
}
