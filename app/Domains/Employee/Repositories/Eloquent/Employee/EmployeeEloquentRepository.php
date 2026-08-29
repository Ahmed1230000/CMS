<?php

namespace App\Domains\Employee\Repositories\Eloquent\Employee;

use App\Domains\Employee\Entities\Employee\EmployeeEntity;
use App\Domains\Employee\Mapper\EmployeeMapper;
use App\Domains\Employee\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeEloquentRepository implements EmployeeRepositoryInterface
{
    public function index()
    {
        return Employee::paginate(10);
    }

    public function show(int $id): EmployeeEntity
    {
        $employee = Employee::findOrFail($id);

        return EmployeeMapper::toEntity($employee);
    }

    public function create(EmployeeEntity $employeeEntity): EmployeeEntity
    {
        $employee = Employee::create([
            'user_id'         => $employeeEntity->user_id,
            'employee_number' => $employeeEntity->employee_number,
            'name'            => $employeeEntity->name,
            'phone'           => $employeeEntity->phone,
            'email'           => $employeeEntity->email,
            'gender'          => $employeeEntity->gender,
            'date_of_birth'   => $employeeEntity->date_of_birth,
            'national_id'     => $employeeEntity->national_id,
            'address'         => $employeeEntity->address,
            'hire_date'       => $employeeEntity->hire_date,
            'job_title'       => $employeeEntity->job_title,
            'is_active'       => $employeeEntity->is_active,
            'created_by'      => $employeeEntity->created_by,
        ]);

        return EmployeeMapper::toEntity($employee);
    }

    public function update(EmployeeEntity $employeeEntity): EmployeeEntity
    {
        $employee = Employee::findOrFail($employeeEntity->id);

        $employee->update([
            'employee_number' => $employeeEntity->employee_number,
            'name'            => $employeeEntity->name,
            'phone'           => $employeeEntity->phone,
            'email'           => $employeeEntity->email,
            'gender'          => $employeeEntity->gender,
            'date_of_birth'   => $employeeEntity->date_of_birth,
            'national_id'     => $employeeEntity->national_id,
            'address'         => $employeeEntity->address,
            'hire_date'       => $employeeEntity->hire_date,
            'job_title'       => $employeeEntity->job_title,
            'is_active'       => $employeeEntity->is_active,
        ]);

        return EmployeeMapper::toEntity($employee->fresh());
    }

    public function delete(int $id): void
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();
    }
}
