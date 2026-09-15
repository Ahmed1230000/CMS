<?php

namespace App\Domains\Invoice\Mapper;

use App\Domains\Invoice\Entities\InvoiceItem\InvoiceItemEntity;
use App\Models\InvoiceItem;

class InvoiceItemMapper
{
    public static function toEntity(InvoiceItem $invoiceItem): InvoiceItemEntity
    {
        return InvoiceItemEntity::reconstitute(
            id: $invoiceItem->id,
            invoiceId: $invoiceItem->invoice_id,
            medicineItemId: $invoiceItem->medicine_item_id,
            quantity: $invoiceItem->quantity,
            unitPrice: (float) $invoiceItem->unit_price,
            total: (float) $invoiceItem->total,
            created_at: $invoiceItem->created_at,
            updated_at: $invoiceItem->updated_at,
        );
    }
}
