<?php

namespace App\Domains\Prescription\DTOs\Prescription;

class IndexPrescriptionDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $patient_name,
        public readonly string $doctor_name,
        public readonly string $appointment_date,
        public readonly string $status,
        public readonly string $created_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            patient_name: $data['patient_name'],
            doctor_name: $data['doctor_name'],
            appointment_date: $data['appointment_date'],
            status: $data['status'],
            created_at: $data['created_at'],
        );
    }
}
