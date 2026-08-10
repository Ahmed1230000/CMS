<?php

namespace App\Domains\Authorization\UseCases\ShowRoleUseCase;

use App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface;


class ShowRoleUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private RolesRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $id)
    {
        return  $this->repository->findById($id);
    }
}
