<?php

namespace App\Domains\Pharmacy\Entities\MedicineItem;

use App\Domains\PHARMACY\Enums\MedicineItemStatusEnum;
use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use Carbon\Carbon;

class MedicineItemEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $medicine_id,
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $strength,
        public readonly ?string $dosage_form,
        public readonly ?string $unit,
        public readonly ?string $barcode,
        public readonly float $selling_price,
        public readonly MedicineStatusEnum $status,
        public readonly ?int $created_by,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function create(array $data): self
    {
        return new self(
            id: null,
            medicine_id: $data['medicine_id'],
            code: $data['code'],
            name: $data['name'],
            strength: $data['strength'] ?? null,
            dosage_form: $data['dosage_form'] ?? null,
            unit: $data['unit'] ?? null,
            barcode: $data['barcode'] ?? null,
            selling_price: $data['selling_price'],
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
            medicine_id: $data['medicine_id'],
            code: $data['code'],
            name: $data['name'],
            strength: $data['strength'] ?? null,
            dosage_form: $data['dosage_form'] ?? null,
            unit: $data['unit'] ?? null,
            barcode: $data['barcode'] ?? null,
            selling_price: $data['selling_price'],
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
            medicine_id: $this->medicine_id,
            code: $data['code'] ?? $this->code,
            name: $data['name'] ?? $this->name,
            strength: $data['strength'] ?? $this->strength,
            dosage_form: $data['dosage_form'] ?? $this->dosage_form,
            unit: $data['unit'] ?? $this->unit,
            barcode: $data['barcode'] ?? $this->barcode,
            selling_price: $data['selling_price'] ?? $this->selling_price,
            status: $this->status,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }

    public function activate(): self
    {
        return new self(
            id: $this->id,
            medicine_id: $this->medicine_id,
            code: $this->code,
            name: $this->name,
            strength: $this->strength,
            dosage_form: $this->dosage_form,
            unit: $this->unit,
            barcode: $this->barcode,
            selling_price: $this->selling_price,
            status: MedicineStatusEnum::ACTIVE,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }

    public function deactivate(): self
    {
        return new self(
            id: $this->id,
            medicine_id: $this->medicine_id,
            code: $this->code,
            name: $this->name,
            strength: $this->strength,
            dosage_form: $this->dosage_form,
            unit: $this->unit,
            barcode: $this->barcode,
            selling_price: $this->selling_price,
            status: MedicineStatusEnum::INACTIVE,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }
}
