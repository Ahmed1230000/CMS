<?php

namespace App\Domains\Prescription\Enums;

enum PrescriptionStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
