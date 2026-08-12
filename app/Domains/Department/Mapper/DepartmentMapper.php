<?php

namespace App\Domains\Department\Mapper;

use App\Domains\Department\Entities\Department\DepartmentEntity;
use App\Models\Department;

class DepartmentMapper
{
    public static function toEntity(Department $department)
    {
        return DepartmentEntity::reconstitute([
            'id'          => $department->id,
            'name'        => $department->name,
            'code'        => $department->code,
            'description' => $department->description,
            'is_active'   => $department->is_active,
            'created_by'  => $department->created_by,
            'created_at'  => $department->created_at,
            'updated_at'  => $department->updated_at,
            'deleted_at'  => $department->deleted_at,
        ]);
    }
}
