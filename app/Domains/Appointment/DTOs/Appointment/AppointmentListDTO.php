<?php

namespace App\Domains\Appointment\DTOs\Appointment;

use Illuminate\Support\Carbon;

class AppointmentListDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $doctor_name,
        public readonly string $patient_name,
        public readonly string $department_name,
        public readonly Carbon $appointment_date,
        public readonly Carbon $start_time,
        public readonly Carbon $end_time,
        public readonly string $status,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: (int) $data['id'],
            doctor_name: (string) $data['doctor_name'],
            patient_name: (string) $data['patient_name'],
            department_name: (string) $data['department_name'],
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
        );
    }
}
