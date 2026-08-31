<?php

namespace App\Domains\Doctor\Repositories\Eloquent\Doctor;

use App\Domains\Doctor\DTOs\Doctor\DoctorListDTO;
use App\Domains\Doctor\DTOs\Doctor\DoctorShowDTO;
use App\Domains\Doctor\Entities\Doctor\DoctorEntity;
use App\Domains\Doctor\Mapper\DoctorMapper;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;
use App\Infrastructure\QueryBuilder\Doctor\DoctorQueryBuilder;
use App\Models\Doctor;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorEloquentRepository implements DoctorRepositoryInterface
{
    public function index()
    {
        return (new DoctorQueryBuilder)
            ->queryIndex()
            ->paginate(10)
            ->through(
                fn($doctor) => DoctorListDTO::fromArray([
                    'id' => $doctor->id,
                    'name' => $doctor->user?->name ?? '',
                    'license_number' => $doctor->license_number,
                    'specialization' => $doctor->specialization,
                    'phone' => $doctor->phone,
                    'email' => $doctor->email,
                    'department_name' => $doctor->department?->name ?? '',
                    'creator_name' => $doctor->creator?->name ?? '',
                    'is_active' => $doctor->is_active,
                ])
            );
    }

    public function show(int $id)
    {
        $doctor = (new DoctorQueryBuilder())->queryShow($id);

        return DoctorShowDTO::fromArray([
            'id' => $doctor->id,
            'name' => $doctor->user?->name ?? '',
            'user_id' => $doctor->user_id,
            'license_number' => $doctor->license_number,
            'specialization' => $doctor->specialization,
            'phone' => $doctor->phone,
            'email' => $doctor->email,
            'department_name' => $doctor->department?->name ?? '',
            'creator_name' => $doctor->creator?->name ?? '',
            'bio' => $doctor->bio,
            'is_active' => $doctor->is_active,
            'created_at' => $doctor->created_at,
            'updated_at' => $doctor->updated_at,
        ]);
    }

    public function create(DoctorEntity $doctorEntity): DoctorEntity
    {
        $doctor = Doctor::create([
            'user_id'         => $doctorEntity->user_id,
            'department_id'   => $doctorEntity->department_id,
            'license_number'  => $doctorEntity->license_number,
            'specialization'  => $doctorEntity->specialization,
            'phone'           => $doctorEntity->phone,
            'email'           => $doctorEntity->email,
            'bio'             => $doctorEntity->bio,
            'is_active'       => $doctorEntity->is_active,
            'created_by'      => $doctorEntity->created_by,
        ]);

        return DoctorMapper::toEntity($doctor);
    }

    public function update(DoctorEntity $doctorEntity): DoctorEntity
    {
        $doctor = Doctor::findOrFail($doctorEntity->id);

        $doctor->update([
            'department_id'   => $doctorEntity->department_id,
            'license_number'  => $doctorEntity->license_number,
            'specialization'  => $doctorEntity->specialization,
            'phone'           => $doctorEntity->phone,
            'email'           => $doctorEntity->email,
            'bio'             => $doctorEntity->bio,
            'is_active'       => $doctorEntity->is_active,
        ]);

        return DoctorMapper::toEntity($doctor->fresh());
    }

    public function delete(int $id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->delete();
    }

    public function find(int $id): ?DoctorEntity
    {
        $doctor = Doctor::find($id);

        return $doctor ? DoctorMapper::toEntity($doctor) : null;
    }
}
