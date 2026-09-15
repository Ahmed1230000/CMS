<?php

namespace App\Domains\Pharmacy\DTOs\Medicine;

class MedicineDTO
{
    public function __construct(
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $generic_name,
        public readonly ?string $manufacturer,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'],
            name: $data['name'],
            generic_name: $data['generic_name'] ?? null,
            manufacturer: $data['manufacturer'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'name' => $this->name,
            'generic_name' => $this->generic_name,
            'manufacturer' => $this->manufacturer,
        ];
    }
}
