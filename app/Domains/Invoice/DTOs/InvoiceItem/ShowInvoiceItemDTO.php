<?php

namespace App\Domains\Invoice\DTOs\InvoiceItem;

class ShowInvoiceItemDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $medicineItemName,
        public readonly string $medicineCode,
        public readonly int $quantity,
        public readonly float $unitPrice,
        public readonly float $total,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            medicineItemName: $data['medicine_item_name'],
            medicineCode: $data['medicine_code'],
            quantity: $data['quantity'],
            unitPrice: (float) $data['unit_price'],
            total: (float) $data['total'],
        );
    }
}
