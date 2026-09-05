<?php

namespace App\Domains\Employee\Entities\Employee;

use Illuminate\Support\Carbon;

class EmployeeEntity
{
    private function __construct(
        public readonly ?int $id,
        public readonly int $user_id,
        public readonly string $employee_number,
        public readonly string $name,
        public readonly string $phone,
        public readonly string $email,
        public readonly string $gender,
        public readonly Carbon $date_of_birth,
        public readonly string $national_id,
        public readonly ?string $address,
        public readonly Carbon $hire_date,
        public readonly string $job_title,
        public readonly bool $is_active,
        public readonly ?int $created_by,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
        public readonly ?Carbon $deleted_at,
    ) {}

    public static function create(
        int $user_id,
        string $employee_number,
        string $name,
        string $phone,
        string $email,
        string $gender,
        Carbon $date_of_birth,
        string $national_id,
        ?string $address,
        Carbon $hire_date,
        string $job_title,
        bool $is_active,
        int $created_by,
    ): self {
        $now = Carbon::now();

        return new self(
            id: null,
            user_id: $user_id,
            employee_number: $employee_number,
            name: $name,
            phone: $phone,
            email: $email,
            gender: $gender,
            date_of_birth: $date_of_birth,
            national_id: $national_id,
            address: $address,
            hire_date: $hire_date,
            job_title: $job_title,
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
            user_id: $data['user_id'],
            employee_number: $data['employee_number'],
            name: $data['name'],
            phone: $data['phone'],
            email: $data['email'],
            gender: $data['gender'],
            date_of_birth: $data['date_of_birth'],
            national_id: $data['national_id'],
            address: $data['address'] ?? null,
            hire_date: $data['hire_date'],
            job_title: $data['job_title'],
            is_active: $data['is_active'],
            created_by: $data['created_by'] ?? null,
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
            deleted_at: $data['deleted_at'] ?? null,
        );
    }

    public function update(
        string $employee_number,
        string $name,
        string $phone,
        string $email,
        string $gender,
        Carbon $date_of_birth,
        string $national_id,
        ?string $address,
        Carbon $hire_date,
        string $job_title,
        bool $is_active,
    ): self {
        return new self(
            id: $this->id,
            user_id: $this->user_id,
            employee_number: $employee_number,
            name: $name,
            phone: $phone,
            email: $email,
            gender: $gender,
            date_of_birth: $date_of_birth,
            national_id: $national_id,
            address: $address,
            hire_date: $hire_date,
            job_title: $job_title,
            is_active: $is_active,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: $this->deleted_at,
        );
    }
}
