<?php

namespace App\Domains\Invoice\Mapper;

use App\Domains\Invoice\Entities\Invoice\InvoiceEntity;
use App\Models\Invoice;

class InvoiceMapper
{
    public static function toEntity(Invoice $invoice): InvoiceEntity
    {
        return InvoiceEntity::reconstitute(
            id: $invoice->id,
            invoiceNumber: $invoice->invoice_number,
            patientId: $invoice->patient_id,
            prescriptionId: $invoice->prescription_id,
            type: $invoice->type,
            status: $invoice->status,
            subtotal: (float) $invoice->subtotal,
            discount: (float) $invoice->discount,
            tax: (float) $invoice->tax,
            total: (float) $invoice->total,
            paidAmount: (float) $invoice->paid_amount,
            remainingAmount: (float) $invoice->remaining_amount,
            created_at: $invoice->created_at,
            updated_at: $invoice->updated_at,
            deleted_at: $invoice->deleted_at,
        );
    }
}
