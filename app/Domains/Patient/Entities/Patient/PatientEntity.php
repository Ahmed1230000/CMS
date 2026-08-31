<?php

namespace App\Domains\Patient\Entities\Patient;

use Illuminate\Support\Carbon;

class PatientEntity
{
    private function __construct(
        public readonly ?int $id,
        public readonly string $patient_number,
        public readonly string $name,
        public readonly string $phone,
        public readonly ?string $email,
        public readonly string $gender,
        public readonly Carbon $date_of_birth,
        public readonly string $national_id,
        public readonly ?string $address,
        public readonly bool $is_active,
        public readonly int $created_by,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
        public readonly ?Carbon $deleted_at,
    ) {}

    public static function create(
        string $patient_number,
        string $name,
        string $phone,
        ?string $email,
        string $gender,
        Carbon $date_of_birth,
        string $national_id,
        ?string $address,
        bool $is_active,
        int $created_by,
    ): self {
        $now = Carbon::now();

        return new self(
            id: null,
            patient_number: $patient_number,
            name: $name,
            phone: $phone,
            email: $email,
            gender: $gender,
            date_of_birth: $date_of_birth,
            national_id: $national_id,
            address: $address,
            is_active: $is_active,
            created_by: $created_by,
            created_at: $now,
            updated_at: $now,
            deleted_at: null,
        );
    }

    public static function reconstitute(array $data): self
    {
        return new self(
            id: $data['id'],
            patient_number: $data['patient_number'],
            name: $data['name'],
            phone: $data['phone'],
            email: $data['email'] ?? null,
            gender: $data['gender'],
            date_of_birth: $data['date_of_birth'],
            national_id: $data['national_id'],
            address: $data['address'] ?? null,
            is_active: $data['is_active'],
            created_by: $data['created_by'],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
            deleted_at: $data['deleted_at'] ?? null,
        );
    }

    public function update(
        string $patient_number,
        string $name,
        string $phone,
        ?string $email,
        string $gender,
        Carbon $date_of_birth,
        string $national_id,
        ?string $address,
        bool $is_active,
    ): self {
        return new self(
            id: $this->id,
            patient_number: $patient_number,
            name: $name,
            phone: $phone,
            email: $email,
            gender: $gender,
            date_of_birth: $date_of_birth,
            national_id: $national_id,
            address: $address,
            is_active: $is_active,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: $this->deleted_at,
        );
    }
    public function isActive(): bool
    {
        return $this->is_active;
    }
}
