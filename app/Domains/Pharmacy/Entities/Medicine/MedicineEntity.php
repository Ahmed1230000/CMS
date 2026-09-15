<?php

namespace App\Domains\Pharmacy\Entities\Medicine;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use Carbon\Carbon;

class MedicineEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $generic_name,
        public readonly ?string $manufacturer,
        public readonly MedicineStatusEnum $status,
        public readonly ?int $created_by,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function create(array $data): self
    {
        return new self(
            id: null,
            code: $data['code'],
            name: $data['name'],
            generic_name: $data['generic_name'] ?? null,
            manufacturer: $data['manufacturer'] ?? null,
            status: MedicineStatusEnum::ACTIVE,
            created_by: auth()->id(),
            created_at: now(),
            updated_at: now(),
        );
    }

    public static function reconstitute(array $data): self
    {
        return new self(
            id: $data['id'],
            code: $data['code'],
            name: $data['name'],
            generic_name: $data['generic_name'] ?? null,
            manufacturer: $data['manufacturer'] ?? null,
            status: $data['status'],
            created_by: $data['created_by'] ?? null,
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }

    public function update(array $data): self
    {
        return new self(
            id: $this->id,
            code: $data['code'] ?? $this->code,
            name: $data['name'] ?? $this->name,
            generic_name: $data['generic_name'] ?? $this->generic_name,
            manufacturer: $data['manufacturer'] ?? $this->manufacturer,
            status: MedicineStatusEnum::ACTIVE,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }

    private function active(): self
    {
        return new self(
            id: $this->id,
            code: $this->code,
            name: $this->name,
            generic_name: $this->generic_name,
            manufacturer: $this->manufacturer,
            status: MedicineStatusEnum::ACTIVE,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }
    private function unactive(): self
    {
        return new self(
            id: $this->id,
            code: $this->code,
            name: $this->name,
            generic_name: $this->generic_name,
            manufacturer: $this->manufacturer,
            status: MedicineStatusEnum::INACTIVE,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }
}
