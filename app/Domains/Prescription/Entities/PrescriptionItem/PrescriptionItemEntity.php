<?php

namespace App\Domains\Prescription\Entities\PrescriptionItem;

use App\Domains\Prescription\Enums\PrescriptionItemStatusEnum;
use Illuminate\Support\Carbon;

class PrescriptionItemEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $prescription_id,
        public readonly string $medication_name,
        public readonly string $dosage,
        public readonly string $frequency,
        public readonly string $duration,
        public readonly ?string $instructions,
        public readonly PrescriptionItemStatusEnum $status,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
        public readonly ?Carbon $deleted_at,
    ) {}

    public static function create(array $data): self
    {
        $now = Carbon::now();

        return new self(
            id: null,
            prescription_id: $data['prescription_id'],
            medication_name: $data['medication_name'],
            dosage: $data['dosage'],
            frequency: $data['frequency'],
            duration: $data['duration'],
            instructions: $data['instructions'] ?? null,
            status: PrescriptionItemStatusEnum::ACTIVE,
            created_at: $now,
            updated_at: $now,
            deleted_at: null,
        );
    }

    public static function reconstitute(array $data): self
    {
        return new self(
            id: $data['id'],
            prescription_id: $data['prescription_id'],
            medication_name: $data['medication_name'],
            dosage: $data['dosage'],
            frequency: $data['frequency'],
            duration: $data['duration'],
            instructions: $data['instructions'] ?? null,
            status: $data['status'] instanceof PrescriptionItemStatusEnum
                ? $data['status']
                : PrescriptionItemStatusEnum::tryFrom($data['status'])
                ?? PrescriptionItemStatusEnum::ACTIVE,
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
            deleted_at: $data['deleted_at'] ?? null,
        );
    }

    public function update(array $data): self
    {
        return new self(
            id: $this->id,
            prescription_id: $this->prescription_id,
            medication_name: $data['medication_name'],
            dosage: $data['dosage'],
            frequency: $data['frequency'],
            duration: $data['duration'],
            instructions: $data['instructions'] ?? null,
            status: $this->status,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: $this->deleted_at,
        );
    }

    public function cancel(): self
    {
        return new self(
            id: $this->id,
            prescription_id: $this->prescription_id,
            medication_name: $this->medication_name,
            dosage: $this->dosage,
            frequency: $this->frequency,
            duration: $this->duration,
            instructions: $this->instructions,
            status: PrescriptionItemStatusEnum::CANCELLED,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: Carbon::now(),
        );
    }
}
