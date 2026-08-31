<?php

namespace App\Infrastructure\QueryBuilder\Employee;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Employee;

class EmployeeQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Employee::class;

    protected array $allowedIncludes = [
        'user',
        'creator',
    ];

    protected array $allowedFilters = [
        'name',
        'employee_number',
        'job_title',
        'phone',
    ];

    protected array $allowedSorts = [
        'name',
        'employee_number',
        'job_title',
        'created_at',
    ];

    public function queryIndex()
    {
        return $this->query()
            ->select([
                'employees.id',
                'employees.user_id',
                'employees.employee_number',
                'employees.name',
                'employees.job_title',
                'employees.phone',
                'employees.email',
                'employees.is_active',
                'employees.created_by',
            ])
            ->with([
                'user:id,name,email',
                'creator:id,name',
            ]);
    }

    public function queryShow(int $id)
    {
        return $this->query()
            ->select([
                'employees.id',
                'employees.user_id',
                'employees.employee_number',
                'employees.name',
                'employees.phone',
                'employees.email',
                'employees.gender',
                'employees.date_of_birth',
                'employees.national_id',
                'employees.address',
                'employees.hire_date',
                'employees.job_title',
                'employees.is_active',
                'employees.created_by',
                'employees.created_at',
                'employees.updated_at',
            ])
            ->with([
                'user:id,name,email',
                'creator:id,name',
            ])
            ->where('employees.id', $id)
            ->firstOrFail();
    }
}
