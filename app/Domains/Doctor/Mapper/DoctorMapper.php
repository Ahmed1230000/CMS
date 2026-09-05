<?php

namespace App\Domains\Doctor\Mapper;

use App\Domains\Doctor\Entities\Doctor\DoctorEntity;
use App\Models\Doctor;

class DoctorMapper
{
    public static function toEntity(Doctor $doctor): DoctorEntity
    {
        return DoctorEntity::reconstitute([
            'id'              => $doctor->id,
            'user_id'         => $doctor->user_id ?? null,
            'department_id'   => $doctor->department_id,
            'license_number'  => $doctor->license_number,
            'specialization'  => $doctor->specialization,
            'phone'           => $doctor->phone,
            'email'           => $doctor->email,
            'bio'             => $doctor->bio,
            'is_active'       => $doctor->is_active,
            'created_by'      => $doctor->created_by ?? null,
            'created_at'      => $doctor->created_at,
            'updated_at'      => $doctor->updated_at,
            'deleted_at'      => $doctor->deleted_at,
        ]);
    }
}
