<?php

namespace App\Infrastructure\QueryBuilder\Doctor;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Doctor;

class DoctorQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Doctor::class;

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