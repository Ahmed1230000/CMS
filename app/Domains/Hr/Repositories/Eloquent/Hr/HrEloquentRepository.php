<?php

namespace App\Domains\Hr\Repositories\Eloquent\Hr;

use App\Domains\Hr\Entities\Hr\HrEntity;
use App\Domains\Hr\Mapper\HrMapper;
use App\Domains\Hr\Repositories\Contracts\Hr\HrRepositoryInterface;
use App\Infrastructure\QueryBuilder\Hr\HrQueryBuilder;
use App\Models\Hr;

class HrEloquentRepository implements HrRepositoryInterface
{
    public function index()
    {
        return (new HrQueryBuilder)->query()->paginate(10);
    }

    public function show(int $id): HrEntity
    {
        $hr = (new HrQueryBuilder)->query()->findOrFail($id);
        return HrMapper::toEntity($hr);
    }


    public function create(HrEntity $hrEntity): HrEntity
    {
        $hr = Hr::createOrFirst([
            'user_id'         => $hrEntity->user_id,
            'employee_number' => $hrEntity->employee_number,
            'name'            => $hrEntity->name,
            'phone'           => $hrEntity->phone,
            'email'           => $hrEntity->email,
            'gender'          => $hrEntity->gender,
            'date_of_birth'   => $hrEntity->date_of_birth,
            'national_id'     => $hrEntity->national_id,
            'address'         => $hrEntity->address,
            'hire_date'       => $hrEntity->hire_date,
            'job_title'       => $hrEntity->job_title,
            'is_active'       => $hrEntity->is_active,
            'created_by'      => $hrEntity->created_by,
        ]);

        return HrMapper::toEntity($hr);
    }

    public function update(HrEntity $hrEntity): HrEntity
    {
        $hr = Hr::findOrFail($hrEntity->id);

        $hr->update([
            'employee_number' => $hrEntity->employee_number,
            'name'            => $hrEntity->name,
            'phone'           => $hrEntity->phone,
            'email'           => $hrEntity->email,
            'gender'          => $hrEntity->gender,
            'date_of_birth'   => $hrEntity->date_of_birth,
            'national_id'     => $hrEntity->national_id,
            'address'         => $hrEntity->address,
            'hire_date'       => $hrEntity->hire_date,
            'job_title'       => $hrEntity->job_title,
            'is_active'       => $hrEntity->is_active,
        ]);

        return HrMapper::toEntity($hr->fresh());
    }

    public function delete(int $id)
    {
        $hr = Hr::findOrFail($id);
        $hr->delete();
    }
}
