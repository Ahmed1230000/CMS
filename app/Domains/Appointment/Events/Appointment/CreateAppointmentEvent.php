<?php

namespace App\Domains\Appointment\Events\Appointment;

use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;

class CreateAppointmentEvent
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(public readonly AppointmentEntity $appointmentEntity) {}
}
