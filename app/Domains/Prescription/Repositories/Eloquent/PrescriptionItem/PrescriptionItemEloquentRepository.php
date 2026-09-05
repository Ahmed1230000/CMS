<?php

namespace App\Domains\Prescription\Repositories\Eloquent\PrescriptionItem;

use App\Domains\Prescription\DTOs\PrescriptionItem\IndexPrescriptionItemDTO;
use App\Domains\Prescription\DTOs\PrescriptionItem\ShowPrescriptionItemDTO;
use App\Domains\Prescription\Entities\PrescriptionItem\PrescriptionItemEntity;
use App\Domains\Prescription\Mapper\PrescriptionItemMapper;
use App\Domains\Prescription\Repositories\Contracts\PrescriptionItem\PrescriptionItemRepositoryInterface;
use App\Infrastructure\QueryBuilder\PrescriptionItem\PrescriptionItemQueryBuilder;
use App\Models\PrescriptionItem;

class PrescriptionItemEloquentRepository implements PrescriptionItemRepositoryInterface
{
    public function create(PrescriptionItemEntity $entity): PrescriptionItemEntity
    {
        $item = PrescriptionItem::query()->create([
            'prescription_id' => $entity->prescription_id,
            'medication_name' => $entity->medication_name,
            'dosage'          => $entity->dosage,
            'frequency'       => $entity->frequency,
            'duration'        => $entity->duration,
            'instructions'    => $entity->instructions,
            'status'          => $entity->status,
        ]);

        return PrescriptionItemMapper::toEntity($item);
    }

    public function update(PrescriptionItemEntity $entity): PrescriptionItemEntity
    {
        $item = PrescriptionItem::query()
            ->findOrFail($entity->id);

        $item->update([
            'medication_name' => $entity->medication_name,
            'dosage'          => $entity->dosage,
            'frequency'       => $entity->frequency,
            'duration'        => $entity->duration,
            'instructions'    => $entity->instructions,
            'status'          => $entity->status,
        ]);

        return PrescriptionItemMapper::toEntity($item->refresh());
    }

    public function cancel(PrescriptionItemEntity $entity): void
    {
        PrescriptionItem::query()
            ->findOrFail($entity->id)
            ->update([
                'status' => $entity->status,
                'deleted_at' => $entity->deleted_at,
            ]);
    }

    public function index(int $prescriptionId)
    {
        return (new PrescriptionItemQueryBuilder())
            ->queryIndex($prescriptionId)
            ->paginate(10)
            ->through(function ($item) {
                return IndexPrescriptionItemDTO::fromArray([
                    'id'              => $item->id,
                    'medication_name' => $item->medication_name,
                    'dosage'          => $item->dosage,
                    'frequency'       => $item->frequency,
                    'duration'        => $item->duration,
                    'instructions'    => $item->instructions,
                    'status'          => $item->status->value,
                ]);
            });
    }

    public function show(int $id): ShowPrescriptionItemDTO
    {
        $item = (new PrescriptionItemQueryBuilder())
            ->queryShow($id);

        return ShowPrescriptionItemDTO::fromArray([
            'id'              => $item->id,
            'prescription_id' => $item->prescription_id,
            'medication_name' => $item->medication_name,
            'dosage'          => $item->dosage,
            'frequency'       => $item->frequency,
            'duration'        => $item->duration,
            'instructions'    => $item->instructions,
            'status'          => $item->status->value,
            'created_at'      => $item->created_at->toDateTimeString(),
            'updated_at'      => $item->updated_at->toDateTimeString(),
        ]);
    }

    public function find(int $id): PrescriptionItemEntity
    {
        $prescription = PrescriptionItem::findOrFail($id);

        return PrescriptionItemMapper::toEntity($prescription);
    }
}
