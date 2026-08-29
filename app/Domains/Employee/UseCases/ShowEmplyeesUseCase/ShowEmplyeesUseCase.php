<?php

namespace App\Domains\Employee\UseCases\ShowEmplyeesUseCase;

use App\Domains\Employee\Repositories\Contracts\Employee\EmployeeRepositoryInterface;


class ShowEmplyeesUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private EmployeeRepositoryInterface $repository
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
