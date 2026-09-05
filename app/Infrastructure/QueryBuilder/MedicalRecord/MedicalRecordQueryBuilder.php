<?php

namespace App\Infrastructure\QueryBuilder\MedicalRecord;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\MedicalRecord;
use Spatie\QueryBuilder\QueryBuilder;

class MedicalRecordQueryBuilder extends BaseQueryBuilder
{
    protected string $model = MedicalRecord::class;

    protected array $allowedIncludes = [
        'patient',
        'creator',
    ];

    protected array $allowedFilters = [
        //
    ];

    protected array $allowedSorts = [
        //
    ];

    public function queryIndex(): QueryBuilder
    {
        return $this->query()
            ->select([
                'medical_records.id',
                'medical_records.patient_id',
                'medical_records.chief_complaint',
                'medical_records.status',
                'medical_records.diagnosis',
            ])->with([
                'patient:id,phone,name',
                'creator:id,name',
            ]);
    }

    public function queryShow(int $id)
    {
        return $this->query()
            ->select([
                'medical_records.id',
                'medical_records.patient_id',
                'medical_records.chief_complaint',
                'medical_records.diagnosis',
                'medical_records.clinical_notes',
                'medical_records.treatment_plan',
                'medical_records.status',
                'medical_records.created_by',
                'medical_records.created_at',
                'medical_records.updated_at',
            ])->with([
                'patient:id,phone,name',
                'creator:id,name',
            ])->where('medical_records.id', $id)->firstOrFail();
    }
}
