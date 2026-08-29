<?php

namespace App\Domains\Hr\Mapper;

use App\Domains\Hr\Entities\Hr\HrEntity;
use App\Models\Hr;

class HrMapper
{
    public static function toEntity(Hr $hr): HrEntity
    {
        return HrEntity::reconstitute([
            'id'              => $hr->id,
            'user_id'         => $hr->user_id,
            'employee_number' => $hr->employee_number,
            'name'            => $hr->name,
            'phone'           => $hr->phone,
            'email'           => $hr->email,
            'gender'          => $hr->gender,
            'date_of_birth'   => $hr->date_of_birth,
            'national_id'     => $hr->national_id,
            'address'         => $hr->address,
            'hire_date'       => $hr->hire_date,
            'job_title'       => $hr->job_title,
            'is_active'       => $hr->is_active,
            'created_by'      => $hr->created_by,
            'created_at'      => $hr->created_at,
            'updated_at'      => $hr->updated_at,
            'deleted_at'      => $hr->deleted_at,
        ]);
    }
}
