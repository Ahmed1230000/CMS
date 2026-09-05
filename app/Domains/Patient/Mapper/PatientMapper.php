<?php

namespace App\Domains\Patient\Mapper;

use App\Domains\Patient\Entities\Patient\PatientEntity;
use App\Models\Patient;

class PatientMapper
{
    public static function toEntity(Patient $patient): PatientEntity
    {
        return PatientEntity::reconstitute([
            'id'             => $patient->id,
            'patient_number' => $patient->patient_number,
            'name'           => $patient->name,
            'phone'          => $patient->phone,
            'email'          => $patient->email,
            'gender'         => $patient->gender,
            'date_of_birth'  => $patient->date_of_birth,
            'national_id'    => $patient->national_id,
            'address'        => $patient->address,
            'is_active'      => $patient->is_active,
            'created_by'     => $patient->created_by ?? null,
            'created_at'     => $patient->created_at,
            'updated_at'     => $patient->updated_at,
            'deleted_at'     => $patient->deleted_at,
        ]);
    }
}
