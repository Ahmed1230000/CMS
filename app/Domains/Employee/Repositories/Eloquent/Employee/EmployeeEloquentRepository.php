<?php

namespace App\Domains\Employee\Repositories\Eloquent\Employee;

use App\Domains\Employee\DTOs\Employee\EmployeeListDTO;
use App\Domains\Employee\DTOs\Employee\EmployeeShowDTO;
use App\Domains\Employee\Entities\Employee\EmployeeEntity;
use App\Domains\Employee\Mapper\EmployeeMapper;
use App\Domains\Employee\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Infrastructure\QueryBuilder\Employee\EmployeeQueryBuilder;
use App\Models\Employee;

class EmployeeEloquentRepository implements EmployeeRepositoryInterface
{
    public function index()
    {
        return (new EmployeeQueryBuilder)
            ->queryIndex()
            ->paginate(10)
            ->through(
                fn($employee) => EmployeeListDTO::fromArray([
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'employee_number' => $employee->employee_number,
                    'job_title' => $employee->job_title,
                    'phone' => $employee->phone,
                    'is_active' => $employee->is_active,
                ])
            );
    }

    public function show(int $id)
    {
        $employee = (new EmployeeQueryBuilder)
            ->queryShow($id);

        return EmployeeShowDTO::fromArray([
            'id' => $employee->id,
            'name' => $employee->name,
            'user_id' => $employee->user_id,
            'employee_number' => $employee->employee_number,
            'phone' => $employee->phone,
            'email' => $employee->email,
            'gender' => $employee->gender,
            'date_of_birth' => $employee->date_of_birth,
            'national_id' => $employee->national_id,
            'address' => $employee->address,
            'hire_date' => $employee->hire_date,
            'job_title' => $employee->job_title,
            'is_active' => $employee->is_active,

            'user_name' => $employee->user?->name ?? '',
            'creator_name' => $employee->creator?->name ?? '',

            'created_at' => $employee->created_at,
            'updated_at' => $employee->updated_at,
        ]);
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
    public function find(int $id): EmployeeEntity
    {
        $employee = Employee::findOrFail($id);
        return EmployeeMapper::toEntity($employee);
    }
}
