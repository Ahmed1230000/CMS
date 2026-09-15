<?php

namespace App\Domains\Invoice\Entities\InvoiceItem;

use Carbon\Carbon;

class InvoiceItemEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $invoiceId,
        public readonly int $medicineItemId,
        public readonly int $quantity,
        public readonly float $unitPrice,
        public readonly float $total,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function create(
        int $invoiceId,
        int $medicineItemId,
        int $quantity,
        float $unitPrice,
    ): self {
        return new self(
            id: null,
            invoiceId: $invoiceId,
            medicineItemId: $medicineItemId,
            quantity: $quantity,
            unitPrice: $unitPrice,
            total: $quantity * $unitPrice,
            created_at: now(),
            updated_at: now(),
        );
    }
    public function update(int $quantity): self
    {
        return new self(
            id: $this->id,
            invoiceId: $this->invoiceId,
            medicineItemId: $this->medicineItemId,
            quantity: $quantity,
            unitPrice: $this->unitPrice,
            total: $quantity * $this->unitPrice,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }

    public static function reconstitute(
        int $id,
        int $invoiceId,
        int $medicineItemId,
        int $quantity,
        float $unitPrice,
        float $total,
        Carbon $created_at,
        Carbon $updated_at,
    ): self {
        return new self(
            id: $id,
            invoiceId: $invoiceId,
            medicineItemId: $medicineItemId,
            quantity: $quantity,
            unitPrice: $unitPrice,
            total: $total,
            created_at: $created_at,
            updated_at: $updated_at,
        );
    }
}
