<?php

namespace App\Infrastructure\QueryBuilder;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseQueryBuilder
{
    protected array $allowedIncludes = [];
    protected array $allowedFilters = [];
    protected array $allowedSorts = [];

    protected string $model;

    public function query(): Builder
    {
        // 🧠 check if spatie exists
        if (class_exists(\Spatie\QueryBuilder\QueryBuilder::class)) {

            $query = \Spatie\QueryBuilder\QueryBuilder::for($this->model);

            if (!empty($this->allowedIncludes)) {
                $query->allowedIncludes($this->allowedIncludes);
            }

            if (!empty($this->allowedFilters)) {
                $query->allowedFilters($this->allowedFilters);
            }

            if (!empty($this->allowedSorts)) {
                $query->allowedSorts($this->allowedSorts);
            }

            return $query;
        }

        // 🧠 fallback (no spatie)
        return app($this->model)->newQuery();
    }
}
