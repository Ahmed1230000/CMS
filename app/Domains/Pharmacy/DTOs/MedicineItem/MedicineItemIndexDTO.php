<?php

namespace App\Domains\Pharmacy\DTOs\MedicineItem;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;

class MedicineItemIndexDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $id,
        public readonly int $medicine_id,
        public readonly string $medicine_name,
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $strength,
        public readonly ?string $dosage_form,
        public readonly ?string $unit,
        public readonly ?string $barcode,
        public readonly float $selling_price,
        public readonly MedicineStatusEnum $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            medicine_id: $data['medicine_id'],
            medicine_name: $data['medicine_name'],
            code: $data['code'],
            name: $data['name'],
            strength: $data['strength'] ?? null,
            dosage_form: $data['dosage_form'] ?? null,
            unit: $data['unit'] ?? null,
            barcode: $data['barcode'] ?? null,
            selling_price: $data['selling_price'],
            status: $data['status'],
        );
    }
}
