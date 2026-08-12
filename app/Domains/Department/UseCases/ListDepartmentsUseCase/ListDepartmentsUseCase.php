<?php

namespace App\Domains\Department\UseCases\ListDepartmentsUseCase;

use App\Domains\Department\Repositories\Contracts\Department\DepartmentRepositoryInterface;


class ListDepartmentsUseCase 
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private DepartmentRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute()
    {
        return $this->repository->list();
    }
}
