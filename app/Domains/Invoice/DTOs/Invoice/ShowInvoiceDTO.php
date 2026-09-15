<?php

namespace App\Domains\Invoice\DTOs\Invoice;

use App\Domains\Invoice\Enums\InvoiceStatusEnum;
use App\Domains\Invoice\Enums\InvoiceTypeEnum;
use Carbon\Carbon;

class ShowInvoiceDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $id,
        public readonly string $invoiceNumber,
        public readonly ?int $patientId,
        public readonly ?string $patientName,
        public readonly ?string $patientPhone,
        public readonly ?string $patientEmail,
        public readonly ?int $prescriptionId,
        public readonly InvoiceTypeEnum $type,
        public readonly InvoiceStatusEnum $status,
        public readonly float $subtotal,
        public readonly float $discount,
        public readonly float $tax,
        public readonly float $total,
        public readonly float $paidAmount,
        public readonly float $remainingAmount,
        public readonly Carbon $createdAt,
        public readonly Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            invoiceNumber: $data['invoice_number'],
            patientId: $data['patient_id'] ?? null,
            patientName: $data['patient_name'] ?? null,
            patientPhone: $data['patient_phone'] ?? null,
            patientEmail: $data['patient_email'] ?? null,
            prescriptionId: $data['prescription_id'] ?? null,
            type: $data['type'],
            status: $data['status'],
            subtotal: (float) $data['subtotal'],
            discount: (float) $data['discount'],
            tax: (float) $data['tax'],
            total: (float) $data['total'],
            paidAmount: (float) $data['paid_amount'],
            remainingAmount: (float) $data['remaining_amount'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
        );
    }
}
