<?php

namespace App\Domains\Authorization\Repositories\Contracts\Roles;

use App\Domains\Authorization\Entities\Roles\RolesEntity;

interface RolesRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function listRoles(int $perPage = 10);
    public function create(RolesEntity $Entity): RolesEntity;
    public function findById(int $id): RolesEntity;
    public function update(RolesEntity $rolesEntity): RolesEntity;
    public function delete(RolesEntity $rolesEntity);
    public function syncPermissions(int $id, array $permissions): void;

    public function getPermissionIds(int $roleId): array;
    public function assignRoleToModel(int $userId, array $roleIds);
}
