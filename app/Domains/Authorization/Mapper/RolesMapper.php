<?php

namespace App\Domains\Authorization\Mapper;

use App\Domains\Authorization\Entities\Roles\RolesEntity;
use App\Models\Roles;

class RolesMapper
{
    public static function toEntity(Roles $role)
    {
        return RolesEntity::reconstitute(
            [
                'id'         => $role->id,
                'name'       => $role->name,
                'guard_name' => $role->guard_name,
                'created_at' => $role->created_at,
                'updated_at' => $role->updated_at
            ]
        );
    }
}
