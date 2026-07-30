<?php

namespace App\Domains\Authorization\DTOs\Permission;

class PermissionDTO
{
    public function __construct(
        // TODO: define properties

        public readonly string $name,
        public readonly string $guard_name,
    ) {}

    public static function fromArray(array $data): self
    {
        // TODO: map data to DTO
        return new self(
            $data['name'],
            $data['guard_name'] ?? 'api'
        );
    }

    public function toArray(): array
    {
        // TODO: map DTO to array
        return [];
    }
}
