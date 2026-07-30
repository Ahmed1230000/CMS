<?php

namespace App\Domains\Authorization\UseCases\SyncUserPermissionsUseCase;

use App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface;
use App\Domains\Authorization\DTOs\Permission\SyncUserPermissionsDTO;

class SyncUserPermissionsUseCase
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

    public function execute(SyncUserPermissionsDTO $dto)
    {
        $this->repository->syncUserPermissions($dto->userId, $dto->permissionIds);
    }
}
