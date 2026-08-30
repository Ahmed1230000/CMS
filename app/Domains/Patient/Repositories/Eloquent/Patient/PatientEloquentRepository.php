<?php

namespace App\Domains\Patient\Repositories\Eloquent\Patient;

use App\Domains\Patient\Entities\Patient\PatientEntity;
use App\Domains\Patient\Mapper\PatientMapper;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;
use App\Models\Patient;

class PatientEloquentRepository implements PatientRepositoryInterface
{
    public function index()
    {
        return Patient::paginate(10);
    }

    public function show(int $id): PatientEntity
    {
        $patient = Patient::findOrFail($id);

        return PatientMapper::toEntity($patient);
    }

    public function create(PatientEntity $patientEntity): PatientEntity
    {
        $patient = Patient::create([
            'patient_number' => $patientEntity->patient_number,
            'name'           => $patientEntity->name,
            'phone'          => $patientEntity->phone,
            'email'          => $patientEntity->email,
            'gender'         => $patientEntity->gender,
            'date_of_birth'  => $patientEntity->date_of_birth,
            'national_id'    => $patientEntity->national_id,
            'address'        => $patientEntity->address,
            'is_active'      => $patientEntity->is_active,
            'created_by'     => $patientEntity->created_by,
        ]);

        return PatientMapper::toEntity($patient);
    }

    public function update(PatientEntity $patientEntity): PatientEntity
    {
        $patient = Patient::findOrFail($patientEntity->id);

        $patient->update([
            'patient_number' => $patientEntity->patient_number,
            'name'           => $patientEntity->name,
            'phone'          => $patientEntity->phone,
            'email'          => $patientEntity->email,
            'gender'         => $patientEntity->gender,
            'date_of_birth'  => $patientEntity->date_of_birth,
            'national_id'    => $patientEntity->national_id,
            'address'        => $patientEntity->address,
            'is_active'      => $patientEntity->is_active,
        ]);

        return PatientMapper::toEntity($patient->fresh());
    }

    public function delete(int $id): void
    {
        $patient = Patient::findOrFail($id);

        $patient->delete();
    }
}