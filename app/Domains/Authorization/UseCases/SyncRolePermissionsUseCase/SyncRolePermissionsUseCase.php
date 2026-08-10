<?php

namespace App\Domains\Authorization\UseCases\SyncRolePermissionsUseCase;

use App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface;
use App\Domains\Authorization\DTOs\Roles\SyncRolePermissionsDTO;
use App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface;

class SyncRolePermissionsUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private RolesRepositoryInterface $repository,
        private PermissionRepositoryInterface $permissionRepositoryInterface
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(SyncRolePermissionsDTO $dto)
    {
        // $role = $this->repository->findById($dto->roleId);
        // $permissions = $this->permissionRepositoryInterface->findMany($dto->permissionIds);

        // dd($dto);

        $this->repository->syncPermissions($dto->roleId, $dto->permissionIds);
    }
}
