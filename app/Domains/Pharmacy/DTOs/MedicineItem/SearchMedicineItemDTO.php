<?php

namespace App\Domains\Pharmacy\DTOs\MedicineItem;

class SearchMedicineItemDTO
{
    public function __construct(
        public readonly string $search,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            search: $data['search'],
        );
    }
}
