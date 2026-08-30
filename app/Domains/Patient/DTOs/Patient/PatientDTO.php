<?php

namespace App\Domains\Patient\DTOs\Patient;

use Illuminate\Support\Carbon;

class PatientDTO
{
    public function __construct(
        public readonly string $patient_number,
        public readonly string $name,
        public readonly string $phone,
        public readonly ?string $email,
        public readonly string $gender,
        public readonly Carbon $date_of_birth,
        public readonly string $national_id,
        public readonly ?string $address,
        public readonly bool $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            patient_number: $data['patient_number'],
            name: $data['name'],
            phone: $data['phone'],
            email: $data['email'] ?? null,
            gender: $data['gender'],
            date_of_birth: Carbon::parse($data['date_of_birth']),
            national_id: $data['national_id'],
            address: $data['address'] ?? null,
            is_active: $data['is_active'] ?? true,
        );
    }

    public function toArray(): array
    {
        return [
            'patient_number' => $this->patient_number,
            'name'           => $this->name,
            'phone'          => $this->phone,
            'email'          => $this->email,
            'gender'         => $this->gender,
            'date_of_birth'  => $this->date_of_birth,
            'national_id'    => $this->national_id,
            'address'        => $this->address,
            'is_active'      => $this->is_active,
        ];
    }
}