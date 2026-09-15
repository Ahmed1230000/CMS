<?php

namespace App\Domains\Invoice\Entities\Invoice;

use App\Domains\Invoice\Enums\InvoiceStatusEnum;
use App\Domains\Invoice\Enums\InvoiceTypeEnum;
use Illuminate\Support\Carbon;

class InvoiceEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $invoiceNumber,
        public readonly ?int $patientId,
        public readonly ?int $prescriptionId,
        public readonly InvoiceTypeEnum $type,
        public readonly InvoiceStatusEnum $status,
        public readonly float $subtotal,
        public readonly float $discount,
        public readonly float $tax,
        public readonly float $total,
        public readonly float $paidAmount,
        public readonly float $remainingAmount,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
        public readonly ?Carbon $deleted_at,
    ) {}

    public static function reconstitute(
        int $id,
        string $invoiceNumber,
        ?int $patientId,
        ?int $prescriptionId,
        InvoiceTypeEnum $type,
        InvoiceStatusEnum $status,
        float $subtotal,
        float $discount,
        float $tax,
        float $total,
        float $paidAmount,
        float $remainingAmount,
        Carbon $created_at,
        Carbon $updated_at,
        ?Carbon $deleted_at,
    ): self {
        return new self(
            id: $id,
            invoiceNumber: $invoiceNumber,
            patientId: $patientId,
            prescriptionId: $prescriptionId,
            type: $type,
            status: $status,
            subtotal: $subtotal,
            discount: $discount,
            tax: $tax,
            total: $total,
            paidAmount: $paidAmount,
            remainingAmount: $remainingAmount,
            created_at: $created_at,
            updated_at: $updated_at,
            deleted_at: $deleted_at,
        );
    }

    public static function create(): self
    {
        $now = new Carbon();
        return new self(
            id: null,
            invoiceNumber: 'IN',
            patientId: null,
            prescriptionId: null,
            type: InvoiceTypeEnum::DIRECT,
            status: InvoiceStatusEnum::DRAFT,
            subtotal: 0,
            discount: 0,
            tax: 0,
            total: 0,
            paidAmount: 0,
            remainingAmount: 0,
            created_at: $now,
            updated_at: $now,
            deleted_at: null,
        );
    }
    public function withInvoiceNumber(): self
    {
        return new self(
            id: $this->id,
            invoiceNumber: 'IN' . '-' . $this->id,
            patientId: null,
            prescriptionId: null,
            type: InvoiceTypeEnum::DIRECT,
            status: InvoiceStatusEnum::DRAFT,
            subtotal: 0,
            discount: 0,
            tax: 0,
            total: 0,
            paidAmount: 0,
            remainingAmount: 0,
            created_at: $this->created_at,
            updated_at: $this->updated_at,
            deleted_at: $this->deleted_at,
        );
    }
}
