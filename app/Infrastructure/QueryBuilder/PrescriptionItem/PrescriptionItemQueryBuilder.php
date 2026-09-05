<?php

namespace App\Infrastructure\QueryBuilder\PrescriptionItem;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\PrescriptionItem;
use Spatie\QueryBuilder\QueryBuilder;

class PrescriptionItemQueryBuilder extends BaseQueryBuilder
{
    protected string $model = PrescriptionItem::class;

    protected array $allowedIncludes = [
        'prescription',
    ];

    protected array $allowedFilters = [
        //
    ];

    protected array $allowedSorts = [
        //
    ];

    public function queryIndex(int $prescriptionId): QueryBuilder
    {
        return $this->query()
            ->select([
                'prescription_items.id',
                'prescription_items.prescription_id',
                'prescription_items.medication_name',
                'prescription_items.dosage',
                'prescription_items.frequency',
                'prescription_items.duration',
                'prescription_items.instructions',
                'prescription_items.status',
                'prescription_items.created_at',
            ])
            ->where('prescription_items.prescription_id', $prescriptionId)
            ->with([
                'prescription:id,patient_id,doctor_id,appointment_id',
            ]);
    }

    public function queryShow(int $id): PrescriptionItem
    {
        return $this->query()
            ->select([
                'prescription_items.id',
                'prescription_items.prescription_id',
                'prescription_items.medication_name',
                'prescription_items.dosage',
                'prescription_items.frequency',
                'prescription_items.duration',
                'prescription_items.instructions',
                'prescription_items.status',
                'prescription_items.created_at',
                'prescription_items.updated_at',
                'prescription_items.deleted_at',
            ])
            ->with([
                'prescription:id,patient_id,doctor_id,appointment_id',
            ])
            ->where('prescription_items.id', $id)
            ->firstOrFail();
    }
}
