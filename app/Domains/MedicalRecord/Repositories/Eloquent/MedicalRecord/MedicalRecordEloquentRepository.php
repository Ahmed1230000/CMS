<?php

namespace App\Domains\MedicalRecord\Repositories\Eloquent\MedicalRecord;

use App\Domains\MedicalRecord\DTOs\MedicalRecord\IndexMedicalRecordDTO;
use App\Domains\MedicalRecord\DTOs\MedicalRecord\ShowMedicalRecordDTO;
use App\Domains\MedicalRecord\Entities\MedicalRecord\MedicalRecordEntity;
use App\Domains\MedicalRecord\Mapper\MedicalRecordMapper;
use App\Domains\MedicalRecord\Repositories\Contracts\MedicalRecord\MedicalRecordRepositoryInterface;
use App\Infrastructure\QueryBuilder\MedicalRecord\MedicalRecordQueryBuilder;
use App\Models\MedicalRecord;

class MedicalRecordEloquentRepository implements MedicalRecordRepositoryInterface
{
    public function index()
    {
        return (new MedicalRecordQueryBuilder())
            ->queryIndex()
            ->paginate(10)
            ->through(fn($medicalRecord) => IndexMedicalRecordDTO::fromArray([
                'id'              => $medicalRecord->id,
                'patient_id'      => $medicalRecord->patient_id,
                'patient_name'    => $medicalRecord->patient?->name,
                'chief_complaint' => $medicalRecord->chief_complaint,
                'diagnosis'       => $medicalRecord->diagnosis,
                'status'          => $medicalRecord->status,
            ]));
    }
    public function show(int $id)
    {
        $medicalRecord = (new MedicalRecordQueryBuilder())
            ->queryShow($id);

        return ShowMedicalRecordDTO::fromArray([
            'id'              => $medicalRecord->id,
            'patient_id'      => $medicalRecord->patient_id,
            'patient_name'    => $medicalRecord->patient?->name,
            'patient_phone'   => $medicalRecord->patient?->phone,
            'chief_complaint' => $medicalRecord->chief_complaint,
            'diagnosis'       => $medicalRecord->diagnosis,
            'status'          => $medicalRecord->status,
            'clinical_notes'  => $medicalRecord->clinical_notes,
            'treatment_plan'  => $medicalRecord->treatment_plan,
            'creator_name'    => $medicalRecord?->creator?->name ?? '',
            'created_at'      => $medicalRecord->created_at,
            'updated_at'      => $medicalRecord->updated_at,
            'deleted_at'      => $medicalRecord->deleted_at,
        ]);
    }
    public function create(MedicalRecordEntity $medicalRecordEntity): MedicalRecordEntity
    {
        $medicalRecord = MedicalRecord::create([
            'patient_id'      => $medicalRecordEntity->patient_id,
            'chief_complaint' => $medicalRecordEntity->chief_complaint,
            'diagnosis'       => $medicalRecordEntity->diagnosis,
            'clinical_notes'  => $medicalRecordEntity->clinical_notes,
            'treatment_plan'  => $medicalRecordEntity->treatment_plan,
            'status'          => $medicalRecordEntity->status,
            'created_by'      => $medicalRecordEntity->created_by,
        ]);

        return MedicalRecordMapper::toEntity($medicalRecord);
    }
    public function update(
        MedicalRecordEntity $medicalRecordEntity
    ): MedicalRecordEntity {
        $medicalRecord = MedicalRecord::findOrFail(
            $medicalRecordEntity->id
        );

        $medicalRecord->update([
            'chief_complaint' => $medicalRecordEntity->chief_complaint,
            'diagnosis'       => $medicalRecordEntity->diagnosis,
            'clinical_notes'  => $medicalRecordEntity->clinical_notes,
            'treatment_plan'  => $medicalRecordEntity->treatment_plan,
        ]);

        return MedicalRecordMapper::toEntity(
            $medicalRecord->fresh()
        );
    }

    public function find(int $id): ?MedicalRecordEntity
    {
        $medicalRecord = MedicalRecord::find($id);

        if (!$medicalRecord) {
            return null;
        }

        return MedicalRecordMapper::toEntity($medicalRecord);
    }
}
