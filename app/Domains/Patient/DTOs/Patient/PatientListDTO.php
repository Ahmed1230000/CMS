<?php

namespace App\Domains\Patient\DTOs\Patient;

class PatientListDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $patient_number,
        public readonly string $name,
        public readonly string $phone,
        public readonly string $gender,
        public readonly bool $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            patient_number: (string) $data['patient_number'],
            name: (string) $data['name'],
            phone: (string) $data['phone'],
            gender: (string) $data['gender'],
            is_active: (bool) $data['is_active'],
        );
    }
}
