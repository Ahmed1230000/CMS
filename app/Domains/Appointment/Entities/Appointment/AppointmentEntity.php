<?php

namespace App\Domains\Appointment\Entities\Appointment;

use App\Domains\Appointment\Enums\AppointmentStatusEnum;
use Illuminate\Support\Carbon;

class AppointmentEntity
{
    private function __construct(
        public readonly ?int $id,
        public readonly int $doctor_id,
        public readonly int $patient_id,
        public readonly int $department_id,
        public readonly Carbon $appointment_date,
        public readonly Carbon $start_time,
        public readonly Carbon $end_time,
        public readonly AppointmentStatusEnum $status,
        public readonly ?string $reason,
        public readonly ?string $notes,
        public readonly ?int $created_by,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
        public readonly ?Carbon $deleted_at,
    ) {}

    public static function create(
        int $doctor_id,
        int $patient_id,
        int $department_id,
        Carbon $appointment_date,
        Carbon $start_time,
        Carbon $end_time,
        ?string $reason,
        ?string $notes,
        int $created_by,
    ): self {
        $now = Carbon::now();

        return new self(
            id: null,
            doctor_id: $doctor_id,
            patient_id: $patient_id,
            department_id: $department_id,
            appointment_date: $appointment_date,
            start_time: $start_time,
            end_time: $end_time,
            status: AppointmentStatusEnum::SCHEDULED,
            reason: $reason,
            notes: $notes,
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
            doctor_id: $data['doctor_id'],
            patient_id: $data['patient_id'],
            department_id: $data['department_id'],
            appointment_date: $data['appointment_date'],
            start_time: $data['start_time'],
            end_time: $data['end_time'],
            status: $data['status'] instanceof AppointmentStatusEnum
                ? $data['status']
                : AppointmentStatusEnum::from($data['status']),
            reason: $data['reason'] ?? null,
            notes: $data['notes'] ?? null,
            created_by: $data['created_by'],
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
            deleted_at: $data['deleted_at'] ?? null,
        );
    }

    public function update(
        Carbon $appointment_date,
        Carbon $start_time,
        Carbon $end_time,
        ?string $reason,
        ?string $notes,
    ): self {
        return new self(
            id: $this->id,
            doctor_id: $this->doctor_id,
            patient_id: $this->patient_id,
            department_id: $this->department_id,
            appointment_date: $appointment_date,
            start_time: $start_time,
            end_time: $end_time,
            status: $this->status,
            reason: $reason,
            notes: $notes,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: $this->deleted_at,
        );
    }

    public function  confirm(): self
    {
        if ($this->status !== AppointmentStatusEnum::SCHEDULED) {
            throw new \DomainException(
                'Only scheduled appointments can be confirmed.'
            );
        }

        return new self(
            id: $this->id,
            doctor_id: $this->doctor_id,
            patient_id: $this->patient_id,
            department_id: $this->department_id,
            appointment_date: $this->appointment_date,
            start_time: $this->start_time,
            end_time: $this->end_time,
            status: AppointmentStatusEnum::CONFIRMED,
            reason: $this->reason,
            notes: $this->notes,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: $this->deleted_at,
        );
    }
    public function complete(): self
    {
        if ($this->status !== AppointmentStatusEnum::SCHEDULED && $this->status !== AppointmentStatusEnum::CONFIRMED) {
            throw new \DomainException(
                'Only scheduled Or confirmed appointments can be confirmed.'
            );
        }

        return new self(
            id: $this->id,
            doctor_id: $this->doctor_id,
            patient_id: $this->patient_id,
            department_id: $this->department_id,
            appointment_date: $this->appointment_date,
            start_time: $this->start_time,
            end_time: $this->end_time,
            status: AppointmentStatusEnum::COMPLETED,
            reason: $this->reason,
            notes: $this->notes,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: $this->deleted_at,
        );
    }
    public function cancel(): self
    {
        if ($this->status !== AppointmentStatusEnum::SCHEDULED && $this->status !== AppointmentStatusEnum::CONFIRMED) {
            throw new \DomainException(
                'Only scheduled or confirmed appointments can be cancelled.'
            );
        }

        return new self(
            id: $this->id,
            doctor_id: $this->doctor_id,
            patient_id: $this->patient_id,
            department_id: $this->department_id,
            appointment_date: $this->appointment_date,
            start_time: $this->start_time,
            end_time: $this->end_time,
            status: AppointmentStatusEnum::CANCELLED,
            reason: $this->reason,
            notes: $this->notes,
            created_by: $this->created_by,
            created_at: $this->created_at,
            updated_at: Carbon::now(),
            deleted_at: $this->deleted_at,
        );
    }
}
