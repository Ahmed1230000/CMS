<?php

namespace App\Domains\Appointment\Repositories\Eloquent\Appointment;

use App\Domains\Appointment\DTOs\Appointment\AppointmentListDTO;
use App\Domains\Appointment\DTOs\Appointment\AppointmentShowDTO;
use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Domains\Appointment\Enums\AppointmentStatusEnum;
use App\Domains\Appointment\Mapper\AppointmentMapper;
use App\Domains\Appointment\Repositories\Contracts\Appointment\AppointmentRepositoryInterface;
use App\Infrastructure\QueryBuilder\Appointment\AppointmentQueryBuilder;
use App\Models\Appointment;
use Illuminate\Support\Carbon;

class AppointmentEloquentRepository implements AppointmentRepositoryInterface
{
    public function index()
    {
        return (new AppointmentQueryBuilder)
            ->queryIndex()
            ->paginate(10)
            ->through(
                fn($appointment) => AppointmentListDTO::fromArray([
                    'id' => $appointment->id,

                    'doctor_name' => $appointment->doctor?->user?->name ?? '',

                    'patient_name' => $appointment->patient?->name ?? '',

                    'department_name' => $appointment->department?->name ?? '',

                    'appointment_date' => $appointment->appointment_date,

                    'start_time' => $appointment->start_time,

                    'end_time' => $appointment->end_time,

                    'status' => $appointment->status->value,
                ])
            );
    }

    public function show(int $id)
    {
        $appointment = (new AppointmentQueryBuilder)
            ->queryShow($id);

        return AppointmentShowDTO::fromArray([
            'id' => $appointment->id,

            'doctor_name' => $appointment->doctor?->user?->name ?? '',

            'doctor_id' => $appointment->doctor_id,

            'patient_name' => $appointment->patient?->name ?? '',

            'department_name' => $appointment->department?->name ?? '',

            'appointment_date' => $appointment->appointment_date,

            'start_time' => $appointment->start_time,

            'end_time' => $appointment->end_time,

            'status' => $appointment->status->value,

            'reason' => $appointment->reason,

            'notes' => $appointment->notes,

            'creator_name' => $appointment->creator?->name ?? '',

            'created_at' => $appointment->created_at,

            'updated_at' => $appointment->updated_at,
        ]);
    }

    public function create(
        AppointmentEntity $appointmentEntity
    ): AppointmentEntity {
        $appointment = Appointment::create([
            'doctor_id'        => $appointmentEntity->doctor_id,
            'patient_id'       => $appointmentEntity->patient_id,
            'department_id'    => $appointmentEntity->department_id,
            'appointment_date' => $appointmentEntity->appointment_date,
            'start_time'       => $appointmentEntity->start_time,
            'end_time'         => $appointmentEntity->end_time,
            'status'           => $appointmentEntity->status->value,
            'reason'           => $appointmentEntity->reason,
            'notes'            => $appointmentEntity->notes,
            'created_by'       => $appointmentEntity->created_by,
        ]);

        return AppointmentMapper::toEntity($appointment);
    }

    public function update(
        AppointmentEntity $appointmentEntity
    ): AppointmentEntity {
        $appointment = Appointment::findOrFail(
            $appointmentEntity->id
        );

        $appointment->update([
            'appointment_date' => $appointmentEntity->appointment_date,
            'start_time'       => $appointmentEntity->start_time,
            'end_time'         => $appointmentEntity->end_time,
            'reason'           => $appointmentEntity->reason,
            'notes'            => $appointmentEntity->notes,
            'status'           => $appointmentEntity->status->value,
        ]);

        return AppointmentMapper::toEntity(
            $appointment->fresh()
        );
    }

    public function delete(int $id): void
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();
    }

    public function find(int $id): AppointmentEntity
    {
        $appointment = Appointment::findOrFail($id);
        return AppointmentMapper::toEntity($appointment);
    }

    public function hasConflict(
        int $doctorId,
        Carbon $appointmentDate,
        Carbon $startTime,
        Carbon $endTime,
    ) {
        return Appointment::query()
            ->where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $appointmentDate)
            ->whereIn(
                'status',
                [
                    AppointmentStatusEnum::SCHEDULED,
                    AppointmentStatusEnum::CONFIRMED,
                ]
            )->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })->exists();
    }
}
