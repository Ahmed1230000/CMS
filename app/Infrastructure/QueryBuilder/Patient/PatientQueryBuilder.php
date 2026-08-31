<?php

namespace App\Infrastructure\QueryBuilder\Patient;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Patient;
use Spatie\QueryBuilder\QueryBuilder;

class PatientQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Patient::class;

    protected array $allowedIncludes = [
        'user',
        'creator'
    ];

    protected array $allowedFilters = [
        //
    ];

    protected array $allowedSorts = [
        //
    ];

    public function queryIndex(): QueryBuilder
    {
        return $this->query()->select([
            'patients.id',
            'patients.patient_number',
            'patients.name',
            'patients.phone',
            'patients.gender',
            'patients.is_active',
        ])->with(
            'user:id,name',
            'creator:id,name'
        );
    }
    public function queryShow(int $id): Patient
    {
        return $this->query()
            ->select([
                'patients.id',
                'patients.user_id',
                'patients.patient_number',
                'patients.name',
                'patients.phone',
                'patients.email',
                'patients.gender',
                'patients.date_of_birth',
                'patients.national_id',
                'patients.address',
                'patients.is_active',
                'patients.created_by',
                'patients.created_at',
                'patients.updated_at',
            ])
            ->with([
                'user:id,name,email',
                'creator:id,name',
            ])
            ->where('patients.id', $id)
            ->firstOrFail();
    }
}
