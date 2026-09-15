<?php

namespace App\Infrastructure\QueryBuilder\Medicine;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Medicine;
use Spatie\QueryBuilder\QueryBuilder;

class MedicineQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Medicine::class;

    protected array $allowedIncludes = [
        'createdBy',
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
            'id',
            'code',
            'name',
            'generic_name',
            'status',
        ]);
    }

    public function queryShow(int $id)
    {
        return $this->query()
            ->select([
                'id',
                'code',
                'name',
                'generic_name',
                'manufacturer',
                'status',
                'created_by',
                'created_at',
                'updated_at',
            ])
            ->with([
                'createdBy:id,name',
            ])->where('id', $id)->firstOrFail();
    }

    public function queryFindMedicineName(int $id): QueryBuilder
    {
        return $this->query()
            ->where('id', $id)
            ->select([
                'id',
                'name',
            ]);
    }
}
