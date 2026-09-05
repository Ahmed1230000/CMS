<?php

namespace App\Domains\Prescription\Entities\Prescription;

use App\Domains\Prescription\Enums\PrescriptionStatusEnum;
use Illuminate\Support\Carbon;

class PrescriptionEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $patient_id,
        public readonly int $doctor_id,
        public readonly int $appointment_id,
        public readonly PrescriptionStatusEnum $status,
        public readonly ?int $created_by,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
        public readonly ?Carbon $deleted_at,
    ) {}

    public static function reconstitute(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            patient_id: $data['patient_id'],
            doctor_id: $data['doctor_id'],
            appointment_id: $data['appointment_id'],
            status: PrescriptionStatusEnum::tryFrom($data['status'])
                ?? PrescriptionStatusEnum::ACTIVE,
            created_by: $data['created_by'] ?? null,
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
            deleted_at: $data['deleted_at'] ?? null,
        );
    }

    public static function create(array $data): self
    {
        $now = Carbon::now();

        return new self(
            id: null,
            patient_id: $data['patient_id'],
            doctor_id: $data['doctor_id'],
            appointment_id: $data['appointment_id'],
            status: PrescriptionStatusEnum::ACTIVE,
            created_by: $data['created_by'],
            created_at: $now,
            updated_at: $now,
            deleted_at: null,
        );
    }
}
