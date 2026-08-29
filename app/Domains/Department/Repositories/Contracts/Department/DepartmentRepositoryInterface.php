<?php

namespace App\Domains\Department\Repositories\Contracts\Department;

use App\Domains\Department\Entities\Department\DepartmentEntity;
use Illuminate\Pagination\LengthAwarePaginator;

interface DepartmentRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function create(DepartmentEntity $departmentEntity): DepartmentEntity;

    public function list(): LengthAwarePaginator;

    public function show(int $id): DepartmentEntity;

    public function delete(int $id);

    public function update(DepartmentEntity $departmentEntity): DepartmentEntity;
}
