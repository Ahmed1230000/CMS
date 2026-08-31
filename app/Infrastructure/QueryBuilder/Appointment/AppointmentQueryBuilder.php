<?php

namespace App\Infrastructure\QueryBuilder\Appointment;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Appointment;
use Spatie\QueryBuilder\QueryBuilder;

class AppointmentQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Appointment::class;

    protected array $allowedIncludes = [
        'doctor',
        'patient',
        'department',
        'creator',
    ];

    protected array $allowedFilters = [
        //
    ];

    protected array $allowedSorts = [
        //
    ];

    public function queryIndex(): QueryBuilder
    {
        return $this->query()
            ->select([
                'appointments.id',
                'appointments.doctor_id',
                'appointments.patient_id',
                'appointments.department_id',
                'appointments.appointment_date',
                'appointments.start_time',
                'appointments.end_time',
                'appointments.status',
            ])
            ->with([
                'doctor:id,user_id',
                'doctor.user:id,name',
                'patient:id,name',
                'department:id,name',
            ]);
    }
    public function queryShow(int $id): Appointment
    {
        return $this->query()
            ->select([
                'appointments.id',
                'appointments.doctor_id',
                'appointments.patient_id',
                'appointments.department_id',
                'appointments.appointment_date',
                'appointments.start_time',
                'appointments.end_time',
                'appointments.status',
                'appointments.reason',
                'appointments.notes',
                'appointments.created_by',
                'appointments.created_at',
                'appointments.updated_at',
            ])
            ->with([
                'doctor:id,user_id',
                'doctor.user:id,name',
                'patient:id,name',
                'department:id,name',
                'creator:id,name',
            ])
            ->where('appointments.id', $id)
            ->firstOrFail();
    }
}
