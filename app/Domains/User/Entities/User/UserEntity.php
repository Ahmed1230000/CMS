<?php

namespace App\Domains\User\Entities\User;

class UserEntity
{
    private function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly ?string $email_verified_at,
        public readonly string $password,
        public readonly ?string $remember_token,
        public readonly \DateTimeImmutable $created_at,
        public readonly \DateTimeImmutable $updated_at
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['email_verified_at'] ?? null,
            $data['password'],
            $data['remember_token'] ?? null,
            new \DateTimeImmutable($data['created_at']),
            new \DateTimeImmutable($data['updated_at'])
        );
    }
}
