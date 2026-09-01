<?php

namespace App\Domains\Doctor\Entities\Doctor;

use Illuminate\Support\Carbon;

class DoctorEntity
{
    private function __construct(
        public readonly ?int $id,
        public readonly int $user_id,
        public readonly int $department_id,
        public readonly string $license_number,
        public readonly string $specialization,
        public readonly string $phone,
        public readonly string $email,
        public readonly ?string $bio,
        public readonly bool $is_active,
        public readonly int $created_by,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
        public readonly ?Carbon $deleted_at,
    ) {}

    public static function create(
        int $user_id,
        int $department_id,
        string $license_number,
        string $specialization,
        string $phone,
        string $email,
        ?string $bio,
        bool $is_active,
        int $created_by,
    ): self {
        $now = Carbon::now();

        return new self(
            id: null,
            user_id: $user_id,
            department_id: $department_id,
            license_number: $license_number,
            specialization: $specialization,
            phone: $phone,
            email: $email,
            bio: $bio,
            is_active: $is_active,
            created_by: $created_by,
            created_at: $now,
            updated_at: $now,
            deleted_at: null,
        );
    }

    public static function reconstitute(array $data): self
    {
        return new self(
            id: $data['id'],
            user_id: $data['user_id'],
            department_id: $data['department_id'],
            license_number: $data['license_number'],
            specialization: $data['specialization'],
            phone: $data['phone'],
            email: $data['email'],
            bio: $data['bio'] ?? null,
            is_active: $data['is_active'],
            created_by: $data['created_by'],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
            deleted_at: $data['deleted_at'] ?? null,
        );
    }

    public function update(
        int $department_id,
        string $license_number,
        string $specialization,
        string $phone,
        string $email,
        ?string $bio,
        bool $is_active,
    ): self {
        return new self(
            id: $this->id,
            user_id: $this->user_id,
            department_id: $department_id,
            license_number: $license_number,
            specialization: $specialization,
            phone: $phone,
            email: $email,
            bio: $bio,
            is_active: $is_active,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: $this->deleted_at,
        );
    }
    public function isActive(): bool 
    {
        return $this->is_active;
    }
}
