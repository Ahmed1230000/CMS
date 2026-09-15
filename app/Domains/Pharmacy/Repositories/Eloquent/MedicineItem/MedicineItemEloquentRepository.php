<?php

namespace App\Domains\Pharmacy\Repositories\Eloquent\MedicineItem;

use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemIndexDTO;
use App\Domains\Pharmacy\DTOs\MedicineItem\MedicineItemShowDTO;
use App\Domains\Pharmacy\Entities\MedicineItem\MedicineItemEntity;
use App\Domains\Pharmacy\Mapper\MedicineItemMapper;
use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;
use App\Infrastructure\QueryBuilder\MedicineItem\MedicineItemQueryBuilder;
use App\Models\MedicineItem;

class MedicineItemEloquentRepository implements MedicineItemRepositoryInterface
{
    public function index(int $id)
    {
        return (new MedicineItemQueryBuilder())->queryIndex($id)->paginate(10)->through(
            function ($medicinItem) {
                return MedicineItemIndexDTO::fromArray([
                    'id'            => $medicinItem->id,
                    'medicine_id'   => $medicinItem->medicine_id,
                    'medicine_name' => $medicinItem->medicine?->name,
                    'code'          => $medicinItem->code,
                    'name'          => $medicinItem->name,
                    'strength'      => $medicinItem->strength,
                    'dosage_form'   => $medicinItem->dosage_form,
                    'unit'          => $medicinItem->unit,
                    'barcode'       => $medicinItem->barcode,
                    'selling_price' => $medicinItem->selling_price,
                    'status'        => $medicinItem->status,
                ]);
            }
        );
    }

    public function show(int $id)
    {
        $medicineItem = (new MedicineItemQueryBuilder())->queryShow($id);
        return MedicineItemShowDTO::fromArray([
            'id'                    => $medicineItem->id,
            'medicine_id'           => $medicineItem->medicine_id,
            'medicine_code'         => $medicineItem->medicine?->code,
            'medicine_name'         => $medicineItem->medicine?->name,
            'medicine_generic_name' => $medicineItem->medicine?->generic_name,
            'medicine_manufacturer' => $medicineItem->medicine?->manufacturer,
            'code'                  => $medicineItem->code,
            'name'                  => $medicineItem->name,
            'strength'              => $medicineItem->strength,
            'dosage_form'           => $medicineItem->dosage_form,
            'unit'                  => $medicineItem->unit,
            'barcode'               => $medicineItem->barcode,
            'selling_price'         => $medicineItem->selling_price,
            'status'                => $medicineItem->status,
            'created_by'            => $medicineItem->created_by,
            'created_by_name'       => $medicineItem->createdBy?->name,
            'created_at'            => $medicineItem->created_at,
            'updated_at'            => $medicineItem->updated_at,
        ]);
    }

    public function create(MedicineItemEntity $medicineItemEntity): MedicineItemEntity
    {
        $medicineItem = MedicineItem::create([
            'medicine_id'   => $medicineItemEntity->medicine_id,
            'code'          => $medicineItemEntity->code,
            'name'          => $medicineItemEntity->name,
            'strength'      => $medicineItemEntity->strength,
            'dosage_form'   => $medicineItemEntity->dosage_form,
            'unit'          => $medicineItemEntity->unit,
            'barcode'       => $medicineItemEntity->barcode,
            'selling_price' => $medicineItemEntity->selling_price,
            'status'        => $medicineItemEntity->status,
            'created_by'    => $medicineItemEntity->created_by,
        ]);

        return  MedicineItemMapper::toEntity($medicineItem);
    }
    public function update(MedicineItemEntity $medicineItemEntity): MedicineItemEntity
    {
        $medicineItem = MedicineItem::findOrFail($medicineItemEntity->id);
        $medicineItem->update([
            'medicine_id'   => $medicineItemEntity->medicine_id,
            'code'          => $medicineItemEntity->code,
            'name'          => $medicineItemEntity->name,
            'strength'      => $medicineItemEntity->strength,
            'dosage_form'   => $medicineItemEntity->dosage_form,
            'unit'          => $medicineItemEntity->unit,
            'selling_price' => $medicineItemEntity->selling_price,
            'status'        => $medicineItemEntity->status,
            'created_by'    => $medicineItemEntity->created_by,
        ]);

        return  MedicineItemMapper::toEntity($medicineItem);
    }

    public function find(int $id): MedicineItemEntity
    {
        $medicineItem = MedicineItem::findOrFail($id);
        return  MedicineItemMapper::toEntity($medicineItem);
    }

    public function search(string $search)
    {
        return (new MedicineItemQueryBuilder())->search($search);
    }
}
