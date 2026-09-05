<?php

namespace App\Domains\Prescription\DTOs\PrescriptionItem;

class ShowPrescriptionItemDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $prescription_id,
        public readonly string $medication_name,
        public readonly string $dosage,
        public readonly string $frequency,
        public readonly string $duration,
        public readonly ?string $instructions,
        public readonly string $status,
        public readonly string $created_at,
        public readonly string $updated_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            prescription_id: $data['prescription_id'],
            medication_name: $data['medication_name'],
            dosage: $data['dosage'],
            frequency: $data['frequency'],
            duration: $data['duration'],
            instructions: $data['instructions'] ?? null,
            status: $data['status'],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }
}
