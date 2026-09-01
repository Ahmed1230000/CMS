<?php

namespace App\Domains\Appointment\UseCases\CompleteAppointmentUseCase;

use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Domains\Appointment\Exceptions\Appointment\AppointmentNotFoundException;
use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;


class CompleteAppointmentUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private AppointmentRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $id): AppointmentEntity
    {
        $appointment = $this->repository->find($id);
        if (!$appointment) {
            throw new AppointmentNotFoundException('The selected appointment was not found.');
        }
        $complete = $appointment->complete();

        return $this->repository->update($complete);
    }
}
