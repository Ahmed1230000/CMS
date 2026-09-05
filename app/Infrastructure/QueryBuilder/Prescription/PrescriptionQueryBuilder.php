<?php

namespace App\Infrastructure\QueryBuilder\Prescription;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Prescription;
use Spatie\QueryBuilder\QueryBuilder;

class PrescriptionQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Prescription::class;

    protected array $allowedIncludes = [
        'patient',
        'doctor',
        'appointment',
        'createdBy',
    ];

    protected array $allowedFilters = [
        //
    ];

    protected array $allowedSorts = [
        //
    ];

    public function queryIndex(): QueryBuilder
    {
        return $this->query()->select([
            'prescriptions.id',
            'prescriptions.patient_id',
            'prescriptions.doctor_id',
            'prescriptions.appointment_id',
            'prescriptions.status',
            'prescriptions.created_by',
            'prescriptions.created_at',

        ])->with([
            'patient:id,name',
            'doctor:id,user_id',
            'doctor.user:id,name',
            'appointment:id,appointment_date',
            'createdBy:id,name',
        ]);
    }
    public function queryShow(int $id): Prescription
    {
        return $this->query()
            ->select([
                'prescriptions.id',
                'prescriptions.patient_id',
                'prescriptions.doctor_id',
                'prescriptions.appointment_id',
                'prescriptions.status',
                'prescriptions.created_by',
                'prescriptions.created_at',
                'prescriptions.updated_at',
                'prescriptions.deleted_at',
            ])
            ->with([
                'patient:id,name,phone,email',
                'doctor:id,user_id',
                'doctor.user:id,name',
                'appointment:id,appointment_date,start_time,end_time,status',
                'createdBy:id,name',
            ])
            ->where('prescriptions.id', $id)
            ->firstOrFail();
    }
}
