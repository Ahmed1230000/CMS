<?php

namespace App\Domains\Authorization\UseCases\ListPermissionsUseCase;

use App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface;


class ListPermissionsUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private PermissionRepositoryInterface $repository
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
