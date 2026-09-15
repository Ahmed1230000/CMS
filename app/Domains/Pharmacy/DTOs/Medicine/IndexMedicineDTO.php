<?php

namespace App\Domains\Pharmacy\DTOs\Medicine;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;

class IndexMedicineDTO
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
        public readonly MedicineStatusEnum $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            code: $data['code'],
            name: $data['name'],
            generic_name: $data['generic_name'] ?? null,
            status: $data['status'],
        );
    }
}
