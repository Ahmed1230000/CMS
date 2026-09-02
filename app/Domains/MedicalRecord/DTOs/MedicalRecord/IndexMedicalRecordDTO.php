<?php

namespace App\Domains\MedicalRecord\DTOs\MedicalRecord;

use App\Domains\MedicalRecord\Enums\MedicalRecordStatusEnum;

class IndexMedicalRecordDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $patient_id,
        public readonly ?string $patient_name,
        public readonly ?string $patient_phone,
        public readonly ?string $chief_complaint,
        public readonly ?string $diagnosis,
        public readonly ?MedicalRecordStatusEnum $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            patient_id: (int) $data['patient_id'],
            patient_name: $data['patient_name'] ?? null,
            patient_phone: $data['patient_phone'] ?? null,
            chief_complaint: $data['chief_complaint'] ?? null,
            diagnosis: $data['diagnosis'] ?? null,
            status: $data['status'] instanceof MedicalRecordStatusEnum
                ? $data['status']
                : ($data['status'] !== null
                    ? MedicalRecordStatusEnum::from($data['status'])
                    : null),
        );
    }
}
