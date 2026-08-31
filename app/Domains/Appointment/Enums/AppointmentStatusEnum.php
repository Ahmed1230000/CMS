<?php

namespace App\Domains\Appointment\Enums;

enum AppointmentStatusEnum: string
{
    case SCHEDULED = 'scheduled';
    case CONFIRMED = 'confirmed';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case NO_SHOW = 'no_show';
}
