<?php

namespace App\Domains\Authorization\Repositories\Eloquent\Permission;

use App\Domains\Authorization\Entities\Permission\PermissionEntity;
use App\Domains\Authorization\Entities\Roles\RolesEntity;
use App\Domains\Authorization\Mapper\PermissionMapper;
use App\Domains\Authorization\Repositories\Contracts\Permission\PermissionRepositoryInterface;
use App\Models\Permission;
use App\Models\User;

class PermissionEloquentRepository implements PermissionRepositoryInterface
{

    public function findById(int $id): PermissionEntity
    {
        $permission = Permission::findOrFail($id);
        return PermissionMapper::toEntity($permission);
    }
    public function create(PermissionEntity $permissionEntity): PermissionEntity
    {
        $permission = Permission::create([
            'name'       => $permissionEntity->name,
            'guard_name' => $permissionEntity->guard_name
        ]);

        return PermissionMapper::toEntity($permission);
    }

    public function update(PermissionEntity $permissionEntity): PermissionEntity
    {
        $permission = Permission::findOrFail($permissionEntity->id);

        $permission->update([
            'name' => $permissionEntity->name
        ]);

        return PermissionMapper::toEntity($permission);
    }
    public function delete(PermissionEntity $permissionEntity)
    {
        $permission = Permission::findOrFail($permissionEntity->id);

        $permission->delete();
    }

    public function findMany(array $permissions)
    {
        return Permission::findMany($permissions);
    }

    public function syncUserPermissions(int $userId, array $permissionIds)
    {
        $user = User::findOrFail($userId);
        $user->syncPermissions($permissionIds);
    }
}
