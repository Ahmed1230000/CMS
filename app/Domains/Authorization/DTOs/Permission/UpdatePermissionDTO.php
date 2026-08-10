<?php

namespace App\Domains\Authorization\DTOs\Roles;

class UpdatePermissionDTO
{
    public function __construct(
        // TODO: define properties

        public readonly string $name,
    ) {}

    public static function fromArray(array $data): self
    {
        // TODO: map data to DTO
        return new self(
            $data['name'],
        );
    }

    public function toArray(): array
    {
        // TODO: map DTO to array
        return [];
    }
}
