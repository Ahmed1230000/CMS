<?php

namespace App\Domains\Appointment\Repositories\Contracts\Appointment;

use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use Illuminate\Support\Carbon;

interface AppointmentRepositoryInterface
{
    public function index();

    public function show(int $id);

    public function create(AppointmentEntity $appointmentEntity): AppointmentEntity;

    public function update(AppointmentEntity $appointmentEntity): AppointmentEntity;

    public function delete(int $id): void;

    public function find(int $id): AppointmentEntity;

    public function hasConflict(
        int $doctorId,
        Carbon $appointmentDate,
        Carbon $startTime,
        Carbon $endTime,
    );
}
