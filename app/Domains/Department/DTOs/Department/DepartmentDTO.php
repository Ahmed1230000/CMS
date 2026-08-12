<?php

namespace App\Domains\Department\DTOs\Department;

class DepartmentDTO
{
    public function __construct(
        public readonly string  $name,
        public readonly string  $code,
        public readonly ?string $description,
        public readonly bool    $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            code: $data['code'],
            description: $data['description'] ?? null,
            is_active: $data['is_active'] ?? true,
        );
    }

    public function toArray(): array
    {
        return [
            'name'        => $this->name,
            'code'        => $this->code,
            'description' => $this->description,
            'is_active'   => $this->is_active,
        ];
    }
}
