<?php

namespace App\Domains\Invoice\Enums;

enum InvoiceTypeEnum: string
{
    case PRESCRIPTION = 'prescription';
    case DIRECT = 'direct';
}
