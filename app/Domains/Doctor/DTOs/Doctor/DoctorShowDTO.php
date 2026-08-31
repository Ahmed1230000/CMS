<?php

namespace App\Domains\Doctor\DTOs\Doctor;

use Illuminate\Support\Carbon;

class DoctorShowDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $user_id,
        public readonly string $license_number,
        public readonly string $specialization,
        public readonly string $phone,
        public readonly string $email,
        public readonly string $department_name,
        public readonly string $creator_name,
        public readonly ?string $bio,
        public readonly bool $is_active,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            name: $data['name'],
            user_id: $data['user_id'],
            license_number: $data['license_number'],
            specialization: $data['specialization'],
            phone: $data['phone'],
            email: $data['email'],
            department_name: $data['department_name'],
            creator_name: $data['creator_name'],
            bio: $data['bio'] ?? null,
            is_active: (bool) $data['is_active'],

            created_at: $data['created_at'] instanceof Carbon
                ? $data['created_at']
                : Carbon::parse($data['created_at']),

            updated_at: $data['updated_at'] instanceof Carbon
                ? $data['updated_at']
                : Carbon::parse($data['updated_at']),
        );
    }
}
