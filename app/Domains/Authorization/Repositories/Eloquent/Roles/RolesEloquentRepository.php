<?php

namespace App\Domains\Authorization\Repositories\Eloquent\Roles;

use App\Domains\Authorization\Entities\Roles\RolesEntity;
use App\Domains\Authorization\Mapper\RolesMapper;
use App\Domains\Authorization\Repositories\Contracts\Roles\RolesRepositoryInterface;
use App\Models\Roles;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RolesEloquentRepository implements RolesRepositoryInterface
{
    public function create(RolesEntity $Entity): RolesEntity
    {
        $role = Roles::create([
            'name'       => $Entity->name,
            'guard_name' => $Entity->guard_name,
        ]);
        return RolesMapper::toEntity($role);
    }

    public function findById(int $id): RolesEntity
    {
        $role = Roles::findOrFail($id);
        return RolesMapper::toEntity($role);
    }

    public function update(RolesEntity $entity): RolesEntity
    {
        $role = Roles::findOrFail($entity->id);

        $role->update([
            'name' => $entity->name
        ]);

        return RolesMapper::toEntity($role->fresh());
    }

    public function delete(RolesEntity $entity)
    {
        $role = Roles::findOrFail($entity->id);

        $role->delete();
    }
    public function syncPermissions(int $id, array $permissions): void
    {
        $role = Role::findOrFail($id);
        $role->syncPermissions($permissions);
    }

    public function revokePermissions(int $id, array $permissions): void
    {
        $role = Role::findOrFail($id);

        $role->revoke($permissions);
    }

    public function assignRoleToModel(int $userId, array $roleIds)
    {
        $user = User::findOrFail($userId);

        $user->syncRoles($roleIds);
    }
}
