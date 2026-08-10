<?php

namespace App\Domains\User\DTOs\User;

use App\Domains\User\Entities\User\UserEntity;

class ShowUserDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly \DateTimeImmutable $created_at,
        public readonly \DateTimeImmutable $updated_at
    ) {}

    public static function fromEntity(UserEntity $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            email: $user->email->value(),
            created_at: $user->created_at,
            updated_at: $user->updated_at,
        );
    }
}
