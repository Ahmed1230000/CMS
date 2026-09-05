<?php

namespace App\Domains\Prescription\DTOs\PrescriptionItem;

class PrescriptionItemDTO
{
    public function __construct(
        public readonly int $prescription_id,
        public readonly string $medication_name,
        public readonly string $dosage,
        public readonly string $frequency,
        public readonly string $duration,
        public readonly ?string $instructions,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            prescription_id: $data['prescription_id'],
            medication_name: $data['medication_name'],
            dosage: $data['dosage'],
            frequency: $data['frequency'],
            duration: $data['duration'],
            instructions: $data['instructions'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'prescription_id' => $this->prescription_id,
            'medication_name' => $this->medication_name,
            'dosage' => $this->dosage,
            'frequency' => $this->frequency,
            'duration' => $this->duration,
            'instructions' => $this->instructions,
        ];
    }
}
