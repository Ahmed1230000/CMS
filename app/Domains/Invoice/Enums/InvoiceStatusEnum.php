<?php

namespace App\Domains\Invoice\Enums;

enum InvoiceStatusEnum: string
{
    case DRAFT = 'draft';
    case UNPAID = 'unpaid';
    case PARTIALLY_PAID = 'partially_paid';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
}
