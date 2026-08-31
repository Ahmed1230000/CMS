<?php

namespace App\Domains\Hr\DTOs\Hr;

class HrIndexDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $employee_number,
        public readonly string $hospital_email,
        public readonly string $phone,
        public readonly string $personal_email,
        public readonly bool $is_active,
        public readonly string $creator_name,
    ) {}

    public static function fromModel($hr): self
    {
        return new self(
            id: $hr->id,
            name: $hr->name,
            employee_number: $hr->employee_number,
            hospital_email: $hr->user?->email ?? '',
            phone: $hr->phone,
            personal_email: $hr->email,
            is_active: $hr->is_active,
            creator_name: $hr->creator?->name ?? '',
        );
    }
}