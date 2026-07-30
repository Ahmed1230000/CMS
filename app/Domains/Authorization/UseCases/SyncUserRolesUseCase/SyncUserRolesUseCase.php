<?php

namespace App\Domains\Authorization\UseCases\SyncUserRolesUseCase;

use App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface;
use App\Domains\Authorization\DTOs\Roles\SyncUserRolesDTO;

class SyncUserRolesUseCase
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

    public function execute(SyncUserRolesDTO $dto) 
    {
        $this->repository->assignRoleToModel($dto->userId,$dto->roleIds);
    }
}
