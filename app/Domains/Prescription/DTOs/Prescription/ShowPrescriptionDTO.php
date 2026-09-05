<?php

namespace App\Domains\Prescription\DTOs\Prescription;

class ShowPrescriptionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $patient_name,
        public readonly string $doctor_name,
        public readonly string $appointment_date,
        public readonly string $status,
        public readonly string $created_by,
        public readonly string $created_at,
        public readonly string $updated_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            patient_name: $data['patient_name'],
            doctor_name: $data['doctor_name'],
            appointment_date: $data['appointment_date'],
            status: $data['status'],
            created_by: $data['created_by'],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }
}
