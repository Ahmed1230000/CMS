<?php

namespace App\Domains\Prescription\Enums;

enum PrescriptionItemStatusEnum: string
{
    case ACTIVE = 'active';
    case CANCELLED = 'cancelled';
}
