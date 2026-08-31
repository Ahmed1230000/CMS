<?php

namespace App\Infrastructure\QueryBuilder\Hr;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Hr;
use Spatie\QueryBuilder\QueryBuilder;

class HrQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Hr::class;

    protected array $allowedIncludes = [
        'user',
        'creator',
    ];

    protected array $allowedFilters = [
        //
    ];

    protected array $allowedSorts = [
        //
    ];

    public function indexQuery(): QueryBuilder
    {
        return $this->query()->select([
            'hrs.id',
            'hrs.name',
            'hrs.employee_number',
            'hrs.email',
            'hrs.phone',
            'hrs.user_id',
            'hrs.is_active',
        ])->with([
            'user:id,name,email',
            'creator:id,name'
        ]);
    }

    public function showQuery(int $id)
    {
        return $this->query()
            ->select([
                'hrs.id',
                'hrs.user_id',
                'hrs.employee_number',
                'hrs.name',
                'hrs.phone',
                'hrs.email',
                'hrs.gender',
                'hrs.date_of_birth',
                'hrs.national_id',
                'hrs.address',
                'hrs.hire_date',
                'hrs.job_title',
                'hrs.is_active',
                'hrs.created_by',
                'hrs.created_at',
                'hrs.updated_at',
            ])
            ->with([
                'user:id,name,email',
                'creator:id,name',
            ])
            ->where('hrs.id', $id)
            ->firstOrFail();
    }
}
