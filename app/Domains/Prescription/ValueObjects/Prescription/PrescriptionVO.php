<?php

namespace App\Domains\Prescription\ValueObjects\Prescription;

class PrescriptionVO
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