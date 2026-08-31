<?php

namespace App\Infrastructure\QueryBuilder\Doctor;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Doctor;
use Spatie\QueryBuilder\QueryBuilder;

class DoctorQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Doctor::class;

    protected array $allowedIncludes = [
        'user',
        'department',
        'creator',
    ];

    protected array $allowedFilters = [
        'specialization',
        'license_number',
    ];

    protected array $allowedSorts = [
        'license_number',
        'specialization',
        'created_at',
    ];

    public function queryIndex(): QueryBuilder
    {
        return $this->query()
            ->select([
                'doctors.id',
                'doctors.user_id',
                'doctors.department_id',
                'doctors.license_number',
                'doctors.specialization',
                'doctors.phone',
                'doctors.email',
                'doctors.is_active',
                'doctors.created_by',
            ])
            ->with([
                'user:id,name,email',
                'department:id,name',
                'creator:id,name',
            ]);
    }

    public function queryShow(int $id)
    {
        return $this->query()
            ->select([
                'doctors.id',
                'doctors.user_id',
                'doctors.department_id',
                'doctors.license_number',
                'doctors.specialization',
                'doctors.phone',
                'doctors.email',
                'doctors.bio',
                'doctors.is_active',
                'doctors.created_by',
                'doctors.created_at',
                'doctors.updated_at',
            ])
            ->with([
                'user:id,name,email',
                'department:id,name',
                'creator:id,name',
            ])
            ->where('doctors.id', $id)
            ->firstOrFail();
    }
}
