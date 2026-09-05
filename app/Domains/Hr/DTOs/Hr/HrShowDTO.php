<?php

namespace App\Domains\Hr\DTOs\Hr;

use Illuminate\Support\Carbon;

class HrShowDTO
{
    public function __construct(
        public readonly int $id,
        public readonly ?int $user_id,
        public readonly string $name,
        public readonly string $employee_number,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $gender,
        public readonly Carbon $date_of_birth,
        public readonly string $national_id,
        public readonly ?string $address,
        public readonly Carbon $hire_date,
        public readonly string $job_title,
        public readonly bool $is_active,
        public readonly int $created_by,
        public readonly string $creator_name,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            user_id: (int) $data['user_id'] ?? null,
            name: $data['name'],
            employee_number: $data['employee_number'],
            email: $data['email'],
            phone: $data['phone'],
            gender: $data['gender'],

            date_of_birth: $data['date_of_birth'] instanceof Carbon
                ? $data['date_of_birth']
                : Carbon::parse($data['date_of_birth']),

            national_id: $data['national_id'],
            address: $data['address'] ?? null,

            hire_date: $data['hire_date'] instanceof Carbon
                ? $data['hire_date']
                : Carbon::parse($data['hire_date']),

            job_title: $data['job_title'],
            is_active: (bool) $data['is_active'],

            created_by: (int) $data['created_by'],

            creator_name: (string) ($data['creator_name'] ?? ''),

            created_at: $data['created_at'] instanceof Carbon
                ? $data['created_at']
                : Carbon::parse($data['created_at']),

            updated_at: $data['updated_at'] instanceof Carbon
                ? $data['updated_at']
                : Carbon::parse($data['updated_at']),
        );
    }
}
