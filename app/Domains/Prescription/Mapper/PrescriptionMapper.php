<?php

namespace App\Domains\Prescription\Mapper;

use App\Domains\Prescription\Entities\Prescription\PrescriptionEntity;
use App\Models\Prescription;

class PrescriptionMapper
{
    public static function toEntity(Prescription $prescription): PrescriptionEntity
    {
        return PrescriptionEntity::reconstitute([
            'id'             => $prescription->id,
            'patient_id'     => $prescription->patient_id,
            'doctor_id'      => $prescription->doctor_id,
            'appointment_id' => $prescription->appointment_id,
            'status'         => $prescription->status->value,
            'created_by'     => $prescription->created_by,
            'created_at'     => $prescription->created_at,
            'updated_at'     => $prescription->updated_at,
            'deleted_at'     => $prescription->deleted_at,
        ]);
    }
}
