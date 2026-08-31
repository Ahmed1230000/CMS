<?php

namespace App\Domains\Appointment\DTOs\Appointment;

use Illuminate\Support\Carbon;

class AppointmentShowDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $doctor_name,
        public readonly int $doctor_id,
        public readonly string $patient_name,
        public readonly int $patient_id,
        public readonly string $department_name,
        public readonly int $department_id,
        public readonly Carbon $appointment_date,
        public readonly Carbon $start_time,
        public readonly Carbon $end_time,
        public readonly string $status,
        public readonly ?string $reason,
        public readonly ?string $notes,
        public readonly string $creator_name,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],

            doctor_name: (string) ($data['doctor_name'] ?? ''),
            doctor_id: (int) ($data['doctor_id'] ?? ''),

            patient_name: (string) ($data['patient_name'] ?? ''),
            patient_id: (int) ($data['patient_id'] ?? ''),

            department_name: (string) ($data['department_name'] ?? ''),
            department_id: (int) ($data['department_id'] ?? ''),

            appointment_date: $data['appointment_date'] instanceof Carbon
                ? $data['appointment_date']
                : Carbon::parse($data['appointment_date']),

            start_time: $data['start_time'] instanceof Carbon
                ? $data['start_time']
                : Carbon::parse($data['start_time']),

            end_time: $data['end_time'] instanceof Carbon
                ? $data['end_time']
                : Carbon::parse($data['end_time']),

            status: (string) $data['status'],

            reason: $data['reason'] ?? null,

            notes: $data['notes'] ?? null,

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
