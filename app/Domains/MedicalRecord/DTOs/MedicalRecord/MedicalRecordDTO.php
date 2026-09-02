<?php

namespace App\Domains\MedicalRecord\DTOs\MedicalRecord;

class MedicalRecordDTO
{
    public function __construct(
        public readonly int $patient_id,
        public readonly ?string $chief_complaint,
        public readonly ?string $diagnosis,
        public readonly ?string $clinical_notes,
        public readonly ?string $treatment_plan,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            patient_id: (int) $data['patient_id'],
            chief_complaint: $data['chief_complaint'] ?? null,
            diagnosis: $data['diagnosis'] ?? null,
            clinical_notes: $data['clinical_notes'] ?? null,
            treatment_plan: $data['treatment_plan'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'patient_id' => $this->patient_id,
            'chief_complaint' => $this->chief_complaint,
            'diagnosis' => $this->diagnosis,
            'clinical_notes' => $this->clinical_notes,
            'treatment_plan' => $this->treatment_plan,
        ];
    }
}
