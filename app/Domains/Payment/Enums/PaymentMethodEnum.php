<?php

namespace App\Domains\Payment\Enums;

enum PaymentMethodEnum: string
{
    case CASH = 'cash';
    case CARD = 'card';


    public function initialStatus(): PaymentStatusEnum
    {
        return match ($this) {
            self::CASH => PaymentStatusEnum::PAID,
            self::CARD => PaymentStatusEnum::PENDING,
        };
    }
}
