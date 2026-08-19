<?php

namespace App\Domains\Department\Repositories\Eloquent\Department;

use App\Domains\Department\Entities\Department\DepartmentEntity;
use App\Domains\Department\Mapper\DepartmentMapper;
use App\Domains\Department\Repositories\Contracts\Department\DepartmentRepositoryInterface;
use App\Infrastructure\QueryBuilder\Department\DepartmentQueryBuilder;
use App\Models\Department;
use Illuminate\Pagination\LengthAwarePaginator;
use Override;

class DepartmentEloquentRepository implements DepartmentRepositoryInterface
{
    public function create(DepartmentEntity $departmentEntity): DepartmentEntity
    {
        $department = Department::createOrFirst(
            [
                'name'        => $departmentEntity->name,
                'code'        => $departmentEntity->code,
                'description' => $departmentEntity->description,
                'is_active'   => $departmentEntity->is_active,
                'created_by'  => $departmentEntity->created_by,
            ]
        );
        return DepartmentMapper::toEntity($department);
    }


    public function list(int $perPage = 10): LengthAwarePaginator
    {
        return Department::paginate($perPage);
    }

    public function show(int $id): DepartmentEntity
    {
        $query = (new DepartmentQueryBuilder)->query();

        $department = $query->findOrFail($id);

        return DepartmentMapper::toEntity($department);
    }

    public function delete(int $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
    }

    #[Override]
    public function update(DepartmentEntity $departmentEntity): DepartmentEntity
    {
        $department = Department::findOrFail($departmentEntity->id);

        $department->update([
            'name'        => $departmentEntity->name,
            'code'        => $departmentEntity->code,
            'description' => $departmentEntity->description,
            'is_active'   => $departmentEntity->is_active,
        ]);

        return DepartmentMapper::toEntity($department);
    }
}
