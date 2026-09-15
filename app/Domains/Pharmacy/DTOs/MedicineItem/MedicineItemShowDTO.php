<?php

namespace App\Domains\Pharmacy\DTOs\MedicineItem;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;

class MedicineItemShowDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $id,
        public readonly int $medicine_id,
        public readonly string $medicine_code,
        public readonly string $medicine_name,
        public readonly ?string $medicine_generic_name,
        public readonly ?string $medicine_manufacturer,
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $strength,
        public readonly ?string $dosage_form,
        public readonly ?string $unit,
        public readonly ?string $barcode,
        public readonly float $selling_price,
        public readonly MedicineStatusEnum $status,
        public readonly ?int $created_by,
        public readonly ?string $created_by_name,
        public readonly string $created_at,
        public readonly string $updated_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            medicine_id: $data['medicine_id'],
            medicine_code: $data['medicine_code'],
            medicine_name: $data['medicine_name'],
            medicine_generic_name: $data['medicine_generic_name'] ?? null,
            medicine_manufacturer: $data['medicine_manufacturer'] ?? null,
            code: $data['code'],
            name: $data['name'],
            strength: $data['strength'] ?? null,
            dosage_form: $data['dosage_form'] ?? null,
            unit: $data['unit'] ?? null,
            barcode: $data['barcode'] ?? null,
            selling_price: $data['selling_price'],
            status: $data['status'],
            created_by: $data['created_by'] ?? null,
            created_by_name: $data['created_by_name'] ?? null,
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }
}
