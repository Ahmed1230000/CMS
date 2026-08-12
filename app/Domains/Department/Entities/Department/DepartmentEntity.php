<?php

namespace App\Domains\Department\Entities\Department;

use Illuminate\Support\Carbon;

class DepartmentEntity
{
    private function __construct(
        public readonly ?int    $id,
        public readonly string  $name,
        public readonly string  $code,
        public readonly ?string $description,
        public readonly bool    $is_active,
        public readonly ?int    $created_by,
        public readonly Carbon  $created_at,
        public readonly Carbon  $updated_at,
        public readonly ?Carbon $deleted_at,
    ) {}


    public static function reconstitute(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['code'],
            $data['description'],
            $data['is_active'],
            $data['created_by'],
            $data['created_at'],
            $data['updated_at'],
            $data['deleted_at'],
        );
    }

    public static function create(
        string $name,
        ?string $description,
        string $code,
        int $createdBy
    ): self {
        $now = Carbon::now();
        return new self(
            id: null,
            name: $name,
            code: $code,
            description: $description,
            is_active: true,
            created_by: $createdBy,
            created_at: $now,
            updated_at: $now,
            deleted_at: null,
        );
    }

    public function update(
        string $name,
        ?string $description,
        string $code,
        bool $is_active
    ): self {
        $now = Carbon::now();

        return new self(
            id: $this->id,
            name: $name,
            code: $code,
            description: $description,
            is_active: $is_active,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: $now,
            deleted_at: $this->deleted_at,
        );
    }
}
