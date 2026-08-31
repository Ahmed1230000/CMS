<?php

namespace App\Domains\Appointment\DTOs\Appointment;

use Illuminate\Support\Carbon;

class AppointmentDTO
{
    public function __construct(
        public readonly ?int $doctor_id,
        public readonly ?int $patient_id,
        public readonly Carbon $appointment_date,
        public readonly Carbon $start_time,
        public readonly Carbon $end_time,
        public readonly ?string $reason,
        public readonly ?string $notes,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            doctor_id: isset($data['doctor_id'])
                ? (int) $data['doctor_id']
                : null,

            patient_id: isset($data['patient_id'])
                ? (int) $data['patient_id']
                : null,
            appointment_date: Carbon::parse($data['appointment_date']),
            start_time: Carbon::parse($data['start_time']),
            end_time: Carbon::parse($data['end_time']),
            reason: $data['reason'] ?? null,
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'doctor_id' => $this->doctor_id,
            'patient_id' => $this->patient_id,
            'appointment_date' => $this->appointment_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'reason' => $this->reason,
            'notes' => $this->notes,
        ];
    }
}
