<?php

namespace App\Domains\Appointment\UseCases\CancelAppointmentUseCase;

use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Domains\Appointment\Exceptions\Appointment\AppointmentNotFoundException;
use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;


class CancelAppointmentUseCase
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
        $cancel = $appointment->cancel();

        return $this->repository->update($cancel);
    }
}
