<?php

namespace App\Domains\Appointment\UseCases\ConfirmAppointmentUseCase;

use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Domains\Appointment\Exceptions\Appointment\AppointmentNotFoundException;
use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;

class ConfirmAppointmentUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        protected AppointmentRepositoryInterface $appointmentRepositoryInterface
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $id): AppointmentEntity
    {
        $appointment = $this->appointmentRepositoryInterface->find($id);
        if (!$appointment) {

            throw new AppointmentNotFoundException('The selected appointment was not found.');
        }

        $confirm = $appointment->confirm();

        return $this->appointmentRepositoryInterface->update($confirm);
    }
}
