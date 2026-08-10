<?php

namespace App\Domains\Authorization\UseCases\ShowPermissionUseCase;

use App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface;


class ShowPermissionUseCase
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

    public function execute(int $id)
    {
        return $this->repository->findById($id);
    }
}
