<?php

namespace App\Domains\Authorization\UseCases\ListRolesUseCase;

use App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface;


class ListRolesUseCase
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

    public function execute(int $perPage = 5)
    {
        return $this->repository->listRoles($perPage);
    }
}
