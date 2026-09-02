<?php

namespace App\Domains\MedicalRecord\DTOs\MedicalRecord;

use App\Domains\MedicalRecord\Enums\MedicalRecordStatusEnum;
use Illuminate\Support\Carbon;

class ShowMedicalRecordDTO
{
    public function __construct(
        public readonly int $id,
        public readonly int $patient_id,
        public readonly ?string $patient_name,
        public readonly ?string $patient_phone,

        public readonly ?string $chief_complaint,
        public readonly ?string $diagnosis,
        public readonly ?string $clinical_notes,
        public readonly ?string $treatment_plan,

        public readonly MedicalRecordStatusEnum $status,

        public readonly ?string $creator_name,

        public readonly ?Carbon $created_at,
        public readonly ?Carbon $updated_at,
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
            clinical_notes: $data['clinical_notes'] ?? null,
            treatment_plan: $data['treatment_plan'] ?? null,

            status: $data['status'] instanceof MedicalRecordStatusEnum
                ? $data['status']
                : MedicalRecordStatusEnum::from($data['status']),

            creator_name: $data['creator_name'] ?? null,

            created_at: isset($data['created_at'])
                ? (
                    $data['created_at'] instanceof Carbon
                    ? $data['created_at']
                    : Carbon::parse($data['created_at'])
                )
                : null,

            updated_at: isset($data['updated_at'])
                ? (
                    $data['updated_at'] instanceof Carbon
                    ? $data['updated_at']
                    : Carbon::parse($data['updated_at'])
                )
                : null,
        );
    }
}
