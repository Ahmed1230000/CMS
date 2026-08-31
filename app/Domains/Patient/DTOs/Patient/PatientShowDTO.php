<?php

namespace App\Domains\Patient\DTOs\Patient;

use Illuminate\Support\Carbon;

class PatientShowDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $patient_number,
        public readonly string $name,
        public readonly string $phone,
        public readonly ?string $email,
        public readonly string $gender,
        public readonly Carbon $date_of_birth,
        public readonly string $national_id,
        public readonly ?string $address,
        public readonly bool $is_active,
        public readonly string $user_name,
        public readonly ?string $user_email,
        public readonly string $creator_name,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            patient_number: (string) $data['patient_number'],
            name: (string) $data['name'],
            phone: (string) $data['phone'],
            email: $data['email'] ?? null,
            gender: (string) $data['gender'],

            date_of_birth: $data['date_of_birth'] instanceof Carbon
                ? $data['date_of_birth']
                : Carbon::parse($data['date_of_birth']),

            national_id: (string) $data['national_id'],
            address: $data['address'] ?? null,

            is_active: (bool) $data['is_active'],

            user_name: (string) ($data['user_name'] ?? ''),
            user_email: $data['user_email'] ?? null,

            creator_name: (string) ($data['creator_name'] ?? ''),

            created_at: $data['created_at'] instanceof Carbon
                ? $data['created_at']
                : Carbon::parse($data['created_at']),

            updated_at: $data['updated_at'] instanceof Carbon
                ? $data['updated_at']
                : Carbon::parse($data['updated_at']),
        );
    }
}
