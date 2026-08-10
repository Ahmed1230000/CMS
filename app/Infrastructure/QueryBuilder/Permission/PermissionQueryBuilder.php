<?php

namespace App\Infrastructure\QueryBuilder\Permission;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Permission;

class PermissionQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Permission::class;

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