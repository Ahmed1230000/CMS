<?php

namespace App\Domains\Pharmacy\Mapper;

use App\Domains\Pharmacy\Entities\MedicineItem\MedicineItemEntity;
use App\Models\MedicineItem;

class MedicineItemMapper
{
    public static function toEntity(MedicineItem $medicineItem): MedicineItemEntity
    {
        return MedicineItemEntity::reconstitute([
            'id'            => $medicineItem->id,
            'medicine_id'   => $medicineItem->medicine_id,
            'code'          => $medicineItem->code,
            'name'          => $medicineItem->name,
            'strength'      => $medicineItem->strength,
            'dosage_form'   => $medicineItem->dosage_form,
            'unit'          => $medicineItem->unit,
            'barcode'       => $medicineItem->barcode,
            'selling_price' => $medicineItem->selling_price,
            'status'        => $medicineItem->status,
            'created_by'    => $medicineItem->created_by,
            'created_at'    => $medicineItem->created_at,
            'updated_at'    => $medicineItem->updated_at,
        ]);
    }
}
