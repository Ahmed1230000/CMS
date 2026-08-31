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
    public function show(int $id);
    public function create(EmployeeEntity $employeeEntity): EmployeeEntity;
    public function update(EmployeeEntity $employeeEntity): EmployeeEntity;
    public function delete(int $id);
    public function find(int $id): EmployeeEntity;
}
