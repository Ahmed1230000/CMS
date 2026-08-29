<?php

namespace App\Domains\Employee\UseCases\ListEmplyeesUseCase;

use App\Domains\Employee\Repositories\Contracts\Employee\EmployeeRepositoryInterface;


class ListEmplyeesUseCase
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

    public function execute()
    {
        return $this->repository->index();
    }
}
