<?php

namespace App\Domains\Pharmacy\DTOs\MedicineItem;

class MedicineItemDTO
{
    public function __construct(
        public readonly int $medicine_id,
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $strength,
        public readonly ?string $dosage_form,
        public readonly ?string $unit,
        public readonly ?string $barcode,
        public readonly float   $selling_price,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            medicine_id: $data['medicine_id'],
            code: $data['code'],
            name: $data['name'],
            strength: $data['strength'] ?? null,
            dosage_form: $data['dosage_form'] ?? null,
            unit: $data['unit'] ?? null,
            barcode: $data['barcode'] ?? null,
            selling_price: $data['selling_price'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'medicine_id' => $this->medicine_id,
            'code' => $this->code,
            'name' => $this->name,
            'strength' => $this->strength,
            'dosage_form' => $this->dosage_form,
            'unit' => $this->unit,
            'barcode' => $this->barcode,
            'selling_price' => $this->selling_price,
        ];
    }
}
