<?php

namespace App\Domains\Doctor\DTOs\Doctor;

class DoctorListDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $license_number,
        public readonly string $specialization,
        public readonly string $phone,
        public readonly string $email,
        public readonly string $department_name,
        public readonly string $creator_name,
        public readonly bool $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            name: $data['name'],
            license_number: $data['license_number'],
            specialization: $data['specialization'],
            phone: $data['phone'],
            email: $data['email'],
            department_name: $data['department_name'],
            creator_name: $data['creator_name'],
            is_active: (bool) $data['is_active'],
        );
    }
}
