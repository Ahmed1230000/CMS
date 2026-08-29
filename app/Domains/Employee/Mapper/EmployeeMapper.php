<?php

namespace App\Domains\Employee\Mapper;

use App\Domains\Employee\Entities\Employee\EmployeeEntity;
use App\Models\Employee;

class EmployeeMapper
{
    public static function toEntity(Employee $employee): EmployeeEntity
    {
        return EmployeeEntity::reconstitute([
            'id'              => $employee->id,
            'user_id'         => $employee->user_id,
            'employee_number' => $employee->employee_number,
            'name'            => $employee->name,
            'phone'           => $employee->phone,
            'email'           => $employee->email,
            'gender'          => $employee->gender,
            'date_of_birth'   => $employee->date_of_birth,
            'national_id'     => $employee->national_id,
            'address'         => $employee->address,
            'hire_date'       => $employee->hire_date,
            'job_title'       => $employee->job_title,
            'is_active'       => $employee->is_active,
            'created_by'      => $employee->created_by,
            'created_at'      => $employee->created_at,
            'updated_at'      => $employee->updated_at,
            'deleted_at'      => $employee->deleted_at,
        ]);
    }
}
