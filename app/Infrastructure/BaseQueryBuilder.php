<?php

namespace App\Infrastructure;

use Spatie\QueryBuilder\QueryBuilder;

abstract class BaseQueryBuilder
{

    protected array $allowedIncludes = [];
    protected array $allowedFilters = [];
    protected array $allowedSorts = [];

    protected string $model;

    public function query(): QueryBuilder
    {
        // 🧠 check if spatie exists
        if (class_exists(\Spatie\QueryBuilder\QueryBuilder::class)) {

            $query = \Spatie\QueryBuilder\QueryBuilder::for($this->model);

            if (!empty($this->allowedIncludes)) {
                foreach ($this->allowedIncludes as $include)
                    $query->allowedIncludes($include);
            }

            if (!empty($this->allowedFilters)) {
                foreach ($this->allowedFilters as $filter) {
                    $query->allowedFilters($filter);
                }
            }

            if (!empty($this->allowedSorts)) {
                foreach ($this->allowedSorts as $sort) {
                    $query->allowedSorts($sort);
                }
            }

            return $query;
        }

        // 🧠 fallback (no spatie)
        return app($this->model)->newQuery();
    }
}
