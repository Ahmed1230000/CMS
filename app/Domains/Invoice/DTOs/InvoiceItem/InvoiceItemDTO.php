<?php

namespace App\Domains\Invoice\DTOs\InvoiceItem;

class InvoiceItemDTO
{
    public function __construct(
        public readonly int $medicineItemId,
        public readonly int $quantity,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            medicineItemId: $data['medicine_item_id'],
            quantity: $data['quantity'],
        );
    }
}
