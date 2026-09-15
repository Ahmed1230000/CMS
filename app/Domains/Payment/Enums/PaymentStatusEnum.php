<?php

namespace App\Domains\Payment\Enums;

enum PaymentStatusEnum: string
{
    case PENDING = 'pending';
    case PAID  = 'paid';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
    //pending
    //paid
    //failed
    //cancelled
}
