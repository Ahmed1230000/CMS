<?php

namespace App\Domains\MedicalRecord\Mapper;

use App\Domains\MedicalRecord\Entities\MedicalRecord\MedicalRecordEntity;
use App\Models\MedicalRecord;

class MedicalRecordMapper
{
    public static function toEntity(MedicalRecord $medicalRecord): MedicalRecordEntity
    {
        return MedicalRecordEntity::reconstitute([
            'id'              => $medicalRecord->id,
            'patient_id'      => $medicalRecord->patient_id,
            'chief_complaint' => $medicalRecord->chief_complaint,
            'diagnosis'       => $medicalRecord->diagnosis,
            'clinical_notes'  => $medicalRecord->clinical_notes,
            'treatment_plan'  => $medicalRecord->treatment_plan,
            'status'          => $medicalRecord->status,
            'created_by'      => $medicalRecord->created_by ?? null,
            'created_at'      => $medicalRecord->created_at,
            'updated_at'      => $medicalRecord->updated_at,
        ]);
    }
}
