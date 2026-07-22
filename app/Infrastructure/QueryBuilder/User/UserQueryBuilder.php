<?php

namespace App\Infrastructure\QueryBuilder\User;

use App\Infrastructure\QueryBuilder\BaseQueryBuilder;
use App\Models\User;

class UserQueryBuilder extends BaseQueryBuilder
{
    protected string $model = User::class;

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