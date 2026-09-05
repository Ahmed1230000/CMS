<?php

namespace App\Domains\Prescription\Mapper;

use App\Domains\Prescription\Entities\PrescriptionItem\PrescriptionItemEntity;
use App\Models\Prescription;
use App\Models\PrescriptionItem;

class PrescriptionItemMapper
{
    public static function toEntity(PrescriptionItem $prescription): PrescriptionItemEntity
    {
        return PrescriptionItemEntity::reconstitute([
            'id'             => $prescription->id,
            'prescription_id' => $prescription->prescription_id,
            'medication_name' => $prescription->medication_name,
            'dosage'          => $prescription->dosage,
            'frequency'       => $prescription->frequency,
            'duration'        => $prescription->duration,
            'instructions'    => $prescription->instructions,
            'status'          => $prescription->status->value,
            'created_at'      => $prescription->created_at,
            'updated_at'      => $prescription->updated_at,
            'deleted_at'      => $prescription->deleted_at,
        ]);
    }
}
