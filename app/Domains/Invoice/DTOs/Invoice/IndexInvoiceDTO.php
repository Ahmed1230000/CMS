<?php

namespace App\Domains\Invoice\DTOs\Invoice;

use App\Domains\Invoice\Enums\InvoiceStatusEnum;
use App\Domains\Invoice\Enums\InvoiceTypeEnum;
use Illuminate\Support\Carbon;

class IndexInvoiceDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $id,
        public readonly string $invoiceNumber,
        public readonly ?string $patientName,
        public readonly InvoiceTypeEnum $type,
        public readonly InvoiceStatusEnum $status,
        public readonly float $total,
        public readonly float $paidAmount,
        public readonly float $remainingAmount,
        public readonly Carbon $createdAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            invoiceNumber: $data['invoice_number'],
            patientName: $data['patient_name'] ?? null,
            type: $data['type'],
            status: $data['status'],
            total: (float) $data['total'],
            paidAmount: (float) $data['paid_amount'],
            remainingAmount: (float) $data['remaining_amount'],
            createdAt: $data['created_at'],
        );
    }
}
