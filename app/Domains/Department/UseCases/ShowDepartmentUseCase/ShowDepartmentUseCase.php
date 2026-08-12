<?php

namespace App\Domains\Department\UseCases\ShowDepartmentUseCase;

use App\Domains\Department\Repositories\Contracts\Department\DepartmentRepositoryInterface;


class ShowDepartmentUseCase
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

    public function execute(int $id)
    {
        return $this->repository->show($id);
    }
}
