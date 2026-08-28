<?php

namespace App\Domains\Hr\DTOs\Hr;

use Illuminate\Support\Carbon;

class HrDTO
{
    public function __construct(
        // User data
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,

        // HR data
        public readonly string $employee_number,
        public readonly string $phone,
        public readonly string $personal_email,
        public readonly string $gender,
        public readonly Carbon $date_of_birth,
        public readonly string $national_id,
        public readonly ?string $address,
        public readonly Carbon $hire_date,
        public readonly string $job_title,
        public readonly bool $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],

            employee_number: $data['employee_number'],
            phone: $data['phone'],
            personal_email: $data['personal_email'],
            gender: $data['gender'],
            date_of_birth: Carbon::parse($data['date_of_birth']),
            national_id: $data['national_id'],
            address: $data['address'] ?? null,
            hire_date: Carbon::parse($data['hire_date']),
            job_title: $data['job_title'],
            is_active: $data['is_active'] ?? true,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,

            'employee_number' => $this->employee_number,
            'phone' => $this->phone,
            'personal_email' => $this->personal_email,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'national_id' => $this->national_id,
            'address' => $this->address,
            'hire_date' => $this->hire_date,
            'job_title' => $this->job_title,
            'is_active' => $this->is_active,
        ];
    }
}
