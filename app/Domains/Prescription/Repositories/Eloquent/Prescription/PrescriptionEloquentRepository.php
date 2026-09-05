<?php

namespace App\Domains\Prescription\Repositories\Eloquent\Prescription;

use App\Domains\Prescription\DTOs\Prescription\IndexPrescriptionDTO;
use App\Domains\Prescription\DTOs\Prescription\ShowPrescriptionDTO;
use App\Domains\Prescription\Entities\Prescription\PrescriptionEntity;
use App\Domains\Prescription\Mapper\PrescriptionMapper;
use App\Domains\Prescription\Repositories\Contracts\Prescription\PrescriptionRepositoryInterface;
use App\Infrastructure\QueryBuilder\Prescription\PrescriptionQueryBuilder;
use App\Models\Prescription;

class PrescriptionEloquentRepository implements PrescriptionRepositoryInterface
{
    public function index()
    {
        return (new PrescriptionQueryBuilder())
            ->queryIndex()
            ->paginate(10)
            ->through(function ($prescription) {
                return IndexPrescriptionDTO::fromArray([
                    'id'               => $prescription->id,
                    'patient_name'     => $prescription->patient->name,
                    'doctor_name'      => $prescription->doctor->user->name,
                    'appointment_date' => $prescription->appointment->appointment_date,
                    'status'           => $prescription->status->value,
                    'created_at'       => $prescription->created_at,
                ]);
            });
    }

    public function show(int $id)
    {
        $prescription = (new PrescriptionQueryBuilder())
            ->queryShow($id);

        return ShowPrescriptionDTO::fromArray([
            'id'               => $prescription->id,
            'patient_name'     => $prescription->patient->name,
            'doctor_name'      => $prescription->doctor->user->name,
            'appointment_date' => $prescription->appointment->appointment_date,
            'status'           => $prescription->status->value,
            'created_by'       => $prescription->createdBy->name,
            'created_at'       => $prescription->created_at,
            'updated_at'       => $prescription->updated_at,
        ]);
    }


    public function findActiveByAppointment(int $appointmentId): ?PrescriptionEntity
    {
        $prescription = Prescription::where('appointment_id', $appointmentId)
            ->where('status', 'active')
            ->whereNull('deleted_at')
            ->first();
        return $prescription ? PrescriptionMapper::toEntity($prescription) : null;
    }

    public function create(PrescriptionEntity  $prescriptionEntity): PrescriptionEntity
    {
        $prescription = Prescription::create([
            'patient_id'     => $prescriptionEntity->patient_id,
            'doctor_id'      => $prescriptionEntity->doctor_id,
            'appointment_id' => $prescriptionEntity->appointment_id,
            'status'         => $prescriptionEntity->status->value,
            'created_at'     => $prescriptionEntity->created_at,
            'updated_at'     => $prescriptionEntity->updated_at,
            'created_by'     => $prescriptionEntity->created_by
        ]);

        return PrescriptionMapper::toEntity($prescription);
    }
}
