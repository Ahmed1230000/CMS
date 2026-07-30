<?php

namespace App\Domains\Authorization\Entities\Roles;

class RolesEntity
{
    private function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $guard_name,
        public readonly \DateTimeImmutable $created_at,
        public readonly \DateTimeImmutable $updated_at
    ) {}

    public static function reconstitute(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['guard_name'],
            new \DateTimeImmutable($data['created_at']),
            new \DateTimeImmutable($data['updated_at'])
        );
    }

    public static function create(string $name, string $guard_name)
    {
        $now = new \DateTimeImmutable();
        return new self(
            null,
            $name,
            $guard_name,
            $now,
            $now
        );
    }
    public function update(string $name)
    {
        $now = new \DateTimeImmutable();
        return new self(
            $this->id,
            $name,
            $this->guard_name,
            $this->created_at,
            $now
        );
    }
}
