<?php

namespace App\Domains\Pharmacy\ValueObjects\MedicineItem;

class MedicineItemVO
{
   public function __construct(
        // TODO: define properties
    ) {}

    public static function fromArray(array $data): self
    {
        // TODO: map data to DTO
        return new self();
    }

    public function toArray(): array
    {
        // TODO: map DTO to array
        return [];
    }
}