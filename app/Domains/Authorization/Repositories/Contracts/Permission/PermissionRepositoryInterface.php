<?php

namespace App\Domains\Authorization\Repositories\Contracts\Permission;

use App\Domains\Authorization\Entities\Permission\PermissionEntity;
use App\Domains\Authorization\Entities\Roles\RolesEntity;
use App\Models\Permission;

interface PermissionRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */
    public function findById(int $id): PermissionEntity;
    public function create(PermissionEntity $permissionEntity): PermissionEntity;
    public function update(PermissionEntity $permissionEntity): PermissionEntity;
    public function delete(PermissionEntity $permissionEntity);
    public function findMany(array $permissions);
    public function syncUserPermissions(int $userId, array $permissionIds);
}
