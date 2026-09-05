<?php

namespace App\Domains\Prescription\DTOs\PrescriptionItem;

use App\Domains\Prescription\Enums\PrescriptionItemStatusEnum;

class IndexPrescriptionItemDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $medication_name,
        public readonly string $dosage,
        public readonly string $frequency,
        public readonly string $duration,
        public readonly ?string $instructions,
        public readonly PrescriptionItemStatusEnum $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            medication_name: $data['medication_name'],
            dosage: $data['dosage'],
            frequency: $data['frequency'],
            duration: $data['duration'],
            instructions: $data['instructions'] ?? null,
            status: PrescriptionItemStatusEnum::tryFrom($data['status']),
        );
    }
}
