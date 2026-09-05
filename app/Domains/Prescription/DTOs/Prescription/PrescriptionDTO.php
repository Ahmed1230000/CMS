<?php

namespace App\Domains\Prescription\DTOs\Prescription;

class PrescriptionDTO
{
    public function __construct(
        public readonly int $patient_id,
        public readonly int $doctor_id,
        public readonly int $appointment_id,
        
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            patient_id: $data['patient_id'],
            doctor_id: $data['doctor_id'],
            appointment_id: $data['appointment_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'patient_id' => $this->patient_id,
            'doctor_id' => $this->doctor_id,
            'appointment_id' => $this->appointment_id,
        ];
    }
}
