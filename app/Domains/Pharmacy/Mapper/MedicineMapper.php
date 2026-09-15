<?php

namespace App\Domains\Pharmacy\Mapper;

use App\Domains\Pharmacy\Entities\Medicine\MedicineEntity;
use App\Models\Medicine;

class MedicineMapper
{
    public static function toEntity(Medicine $medicine): MedicineEntity
    {
        return MedicineEntity::reconstitute([
            'id'           => $medicine->id,
            'code'         => $medicine->code,
            'name'         => $medicine->name,
            'generic_name' => $medicine->generic_name,
            'manufacturer' => $medicine->manufacturer,
            'status'       => $medicine->status,
            'created_by'   => $medicine->created_by ?? null,
            'created_at'   => $medicine->created_at,
            'updated_at'   => $medicine->updated_at,
        ]);
    }
}
