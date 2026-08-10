<?php

namespace App\Infrastructure\QueryBuilder\Roles;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Roles;

class RolesQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Roles::class;

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