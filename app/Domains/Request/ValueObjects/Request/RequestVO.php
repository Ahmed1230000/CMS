<?php

namespace App\Domains\Request\ValueObjects\Request;

class RequestVO
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