<?php

namespace App\Domains\Employee\DTOs\Employee;

class EmployeeListDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $employee_number,
        public readonly string $job_title,
        public readonly string $phone,
        public readonly bool $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            name: (string) $data['name'],
            employee_number: (string) $data['employee_number'],
            job_title: (string) $data['job_title'],
            phone: (string) $data['phone'],
            is_active: (bool) $data['is_active'],
        );
    }
}
