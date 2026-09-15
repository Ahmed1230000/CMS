<?php

namespace App\Infrastructure\QueryBuilder\Request;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Request;
use Spatie\QueryBuilder\QueryBuilder;

class RequestQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Request::class;

    protected array $allowedIncludes = [
        'approvedBy',
        'approvedBy',
        'approvedBy',
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
                'id',
                'requester_id',
                'type',
                'status',
                'reason',
                'approved_by',
                'approved_at',
                'rejected_by',
                'rejected_at',
                'created_at',
            ])
            ->with([
                'requester:id,name',
                'approvedBy:id,name',
                'rejectedBy:id,name',
            ]);
    }
    public function queryShow(int $id)
    {
        return $this->query()
            ->select([
                'id',
                'requester_id',
                'type',
                'status',
                'reason',
                'approved_by',
                'approved_at',
                'rejected_by',
                'rejected_at',
                'created_at',
                'updated_at',
            ])
            ->with([
                'requester:id,name',
                'approvedBy:id,name',
                'rejectedBy:id,name',
            ])->where('id', $id)->firstOrFail();
    }
}
