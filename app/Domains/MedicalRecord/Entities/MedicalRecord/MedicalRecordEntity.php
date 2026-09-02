<?php

namespace App\Domains\MedicalRecord\Entities\MedicalRecord;

use App\Domains\MedicalRecord\Enums\MedicalRecordStatusEnum;
use Illuminate\Support\Carbon;

class MedicalRecordEntity
{
    private function __construct(
        public readonly ?int    $id,
        public readonly int     $patient_id,
        public readonly ?string $chief_complaint,
        public readonly ?string $diagnosis,
        public readonly ?string $clinical_notes,
        public readonly ?string $treatment_plan,
        public readonly MedicalRecordStatusEnum $status,
        public readonly int $created_by,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function reconstitute(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            patient_id: $data['patient_id'],
            chief_complaint: $data['chief_complaint'] ?? null,
            diagnosis: $data['diagnosis'] ?? null,
            clinical_notes: $data['clinical_notes'] ?? null,
            treatment_plan: $data['treatment_plan'] ?? null,
            status: $data['status'],
            created_by: $data['created_by'],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }

    public static function create(array $data): self
    {
        return new self(
            id: null,
            patient_id: $data['patient_id'],
            chief_complaint: $data['chief_complaint'] ?? null,
            diagnosis: $data['diagnosis'] ?? null,
            clinical_notes: $data['clinical_notes'] ?? null,
            treatment_plan: $data['treatment_plan'] ?? null,
            status: MedicalRecordStatusEnum::DRAFT,
            created_by: $data['created_by'],
            created_at: Carbon::now(),
            updated_at: Carbon::now(),
        );
    }

    public function update(array $data): self
    {
        return new self(
            id: $this->id,
            patient_id: $this->patient_id,
            chief_complaint: $data['chief_complaint'] ?? $this->chief_complaint,
            diagnosis: $data['diagnosis'] ?? $this->diagnosis,
            clinical_notes: $data['clinical_notes'] ?? $this->clinical_notes,
            treatment_plan: $data['treatment_plan'] ?? $this->treatment_plan,
            status: $this->status,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
        );
    }
}
