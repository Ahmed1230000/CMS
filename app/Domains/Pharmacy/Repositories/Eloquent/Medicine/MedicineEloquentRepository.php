<?php

namespace App\Domains\Pharmacy\Repositories\Eloquent\Medicine;

use App\Domains\Pharmacy\DTOs\Medicine\IndexMedicineDTO;
use App\Domains\Pharmacy\DTOs\Medicine\ShowMedicineDTO;
use App\Domains\Pharmacy\Entities\Medicine\MedicineEntity;
use App\Domains\Pharmacy\Mapper\MedicineMapper;
use App\Domains\Pharmacy\Repositories\Contracts\Medicine\MedicineRepositoryInterface;
use App\Infrastructure\QueryBuilder\Medicine\MedicineQueryBuilder;
use App\Models\Medicine;

class MedicineEloquentRepository implements MedicineRepositoryInterface
{
    public function index()
    {
        return (new MedicineQueryBuilder())
            ->queryIndex()
            ->paginate(10)
            ->through(
                fn($medicine) => IndexMedicineDTO::fromArray([
                    'id'           => $medicine->id,
                    'code'         => $medicine->code,
                    'name'         => $medicine->name,
                    'generic_name' => $medicine->generic_name,
                    'status'       => $medicine->status,
                ])
            );
    }
    public function show(int $id): ShowMedicineDTO
    {
        $medicine = (new MedicineQueryBuilder())
            ->queryShow($id);

        return ShowMedicineDTO::fromArray([
            'id'              => $medicine->id,
            'code'            => $medicine->code,
            'name'            => $medicine->name,
            'generic_name'    => $medicine->generic_name,
            'manufacturer'    => $medicine->manufacturer,
            'status'          => $medicine->status,
            'created_by'      => $medicine->created_by,
            'created_by_name' => $medicine->createdBy?->name,
            'created_at'      => $medicine->created_at,
            'updated_at'      => $medicine->updated_at,
        ]);
    }
    public function create(MedicineEntity $medicineEntity): MedicineEntity
    {
        $medicine = Medicine::create([
            'code'         => $medicineEntity->code,
            'name'         => $medicineEntity->name,
            'generic_name' => $medicineEntity->generic_name,
            'manufacturer' => $medicineEntity->manufacturer,
            'status'       => $medicineEntity->status,
            'created_by'   => $medicineEntity->created_by,
        ]);
        return MedicineMapper::toEntity($medicine);
    }
    public function update(MedicineEntity $medicineEntity): MedicineEntity
    {
        $medicine = Medicine::find($medicineEntity->id);
        $medicine->update([
            'code'         => $medicineEntity->code,
            'name'         => $medicineEntity->name,
            'generic_name' => $medicineEntity->generic_name,
            'manufacturer' => $medicineEntity->manufacturer,
            'status'       => $medicineEntity->status,
            'created_by'   => $medicineEntity->created_by,
        ]);


        return MedicineMapper::toEntity($medicine);
    }

    public function find(int $id): MedicineEntity
    {
        $medicine = Medicine::find($id);
        return MedicineMapper::toEntity($medicine);
    }
    public function findMedicineName(int $id)
    {
        return (new MedicineQueryBuilder())->queryFindMedicineName($id)->firstOrFail();
    }
}
