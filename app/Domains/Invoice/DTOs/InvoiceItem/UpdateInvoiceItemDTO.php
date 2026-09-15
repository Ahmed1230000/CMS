<?php

namespace App\Domains\Invoice\DTOs\InvoiceItem;

class UpdateInvoiceItemDTO
{
    public function __construct(
        public readonly int $quantity,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            quantity: $data['quantity'],
        );
    }
}