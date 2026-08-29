<?php

namespace App\Domains\Employee\Repositories\Contracts\Employee;

use App\Domains\Employee\Entities\Employee\EmployeeEntity;

interface EmployeeRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index();
    public function show(int $id): EmployeeEntity;
    public function create(EmployeeEntity $employeeEntity): EmployeeEntity;
    public function update(EmployeeEntity $employeeEntity): EmployeeEntity;
    public function delete(int $id);
}
