<?php

namespace App\Domains\Doctor\Repositories\Eloquent\Doctor;

use App\Domains\Doctor\Entities\Doctor\DoctorEntity;
use App\Domains\Doctor\Mapper\DoctorMapper;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;
use App\Models\Doctor;
use Illuminate\Pagination\LengthAwarePaginator;

class DoctorEloquentRepository implements DoctorRepositoryInterface
{
    public function index()
    {
        return  Doctor::paginate(10);
    }

    public function show(int $id): DoctorEntity
    {
        $doctor = Doctor::findOrFail($id);

        return DoctorMapper::toEntity($doctor);
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
}
