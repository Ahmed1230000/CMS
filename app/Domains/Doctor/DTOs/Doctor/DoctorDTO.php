<?php

namespace App\Domains\Doctor\DTOs\Doctor;

use Illuminate\Support\Carbon;

class DoctorDTO
{
    public function __construct(
        // User account data
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,

        // Doctor profile data
        public readonly int $department_id,
        public readonly string $license_number,
        public readonly string $specialization,
        public readonly string $phone,
        public readonly string $personal_email,
        public readonly ?string $bio,
        public readonly bool $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],

            department_id: (int) $data['department_id'],
            license_number: $data['license_number'],
            specialization: $data['specialization'],
            phone: $data['phone'],
            personal_email: $data['personal_email'],
            bio: $data['bio'] ?? null,
            is_active: $data['is_active'] ?? true,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,

            'department_id' => $this->department_id,
            'license_number' => $this->license_number,
            'specialization' => $this->specialization,
            'phone' => $this->phone,
            'personal_email' => $this->personal_email,
            'bio' => $this->bio,
            'is_active' => $this->is_active,
        ];
    }
}
