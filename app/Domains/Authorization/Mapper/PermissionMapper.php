<?php

namespace App\Domains\Authorization\Mapper;

use App\Domains\Authorization\Entities\Permission\PermissionEntity;
use App\Models\Permission;

class PermissionMapper
{
    public static function toEntity(Permission $permission)
    {
        return PermissionEntity::reconstitute(
            [
                'id'         => $permission->id,
                'name'       => $permission->name,
                'guard_name' => $permission->guard_name,
                'created_at' => $permission->created_at,
                'updated_at' => $permission->updated_at
            ]
        );
    }
}
