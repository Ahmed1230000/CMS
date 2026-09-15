<?php

namespace App\Domains\Pharmacy\DTOs\Medicine;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;

class ShowMedicineDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $generic_name,
        public readonly ?string $manufacturer,
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
            code: $data['code'],
            name: $data['name'],
            generic_name: $data['generic_name'] ?? null,
            manufacturer: $data['manufacturer'] ?? null,
            status: $data['status'],
            created_by: $data['created_by'] ?? null,
            created_by_name: $data['created_by_name'] ?? null,
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }
}
