<?php

namespace App\Infrastructure\QueryBuilder\Department;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Department;

class DepartmentQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Department::class;

    protected array $allowedIncludes = [
        'creator'
    ];

    protected array $allowedFilters = [
        //
    ];

    protected array $allowedSorts = [
        //
    ];
}