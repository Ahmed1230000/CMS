<?php

namespace App\Domains\Patient\Repositories\Eloquent\Patient;

use App\Domains\Patient\DTOs\Patient\PatientListDTO;
use App\Domains\Patient\DTOs\Patient\PatientShowDTO;
use App\Domains\Patient\Entities\Patient\PatientEntity;
use App\Domains\Patient\Mapper\PatientMapper;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;
use App\Infrastructure\QueryBuilder\Patient\PatientQueryBuilder;
use App\Models\Patient;

class PatientEloquentRepository implements PatientRepositoryInterface
{
    public function index()
    {
        return (new PatientQueryBuilder())->queryIndex()->paginate(10)->through(fn($patient) => PatientListDTO::fromArray([
            'id'             => $patient->id,
            'patient_number' => $patient->patient_number,
            'name'           => $patient->name,
            'phone'          => $patient->phone,
            'gender'         => $patient->gender,
            'is_active'      => $patient->is_active,
        ]));
    }

    public function show(int $id)
    {
        $patient = (new PatientQueryBuilder())->queryShow($id);

        return PatientShowDTO::fromArray([
            'id' => $patient->id,
            'patient_number' => $patient->patient_number,
            'name' => $patient->name,
            'phone' => $patient->phone,
            'email' => $patient->email,
            'gender' => $patient->gender,
            'date_of_birth' => $patient->date_of_birth,
            'national_id' => $patient->national_id,
            'address' => $patient->address,
            'is_active' => $patient->is_active,

            'user_name' => $patient->user?->name,
            'user_email' => $patient->user?->email,

            'creator_name' => $patient->creator?->name ?? '',

            'created_at' => $patient->created_at,
            'updated_at' => $patient->updated_at,
        ]);
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

    public function find(int $id): ?PatientEntity
    {
        $patient = Patient::find($id);

        return $patient ? PatientMapper::toEntity($patient) : null;
    }

    public function searchByPhone(string $phone)
    {
        return (new PatientQueryBuilder())->searchByPhone($phone)->get();
    }
}
