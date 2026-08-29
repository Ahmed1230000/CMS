<?php

namespace App\Infrastructure\QueryBuilder\Hr;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Hr;

class HrQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Hr::class;

    protected array $allowedIncludes = [
        //
    ];

    protected array $allowedFilters = [
        //
    ];

    protected array $allowedSorts = [
        //
    ];
}