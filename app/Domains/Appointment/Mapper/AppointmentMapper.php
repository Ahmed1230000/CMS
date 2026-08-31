<?php

namespace App\Domains\Appointment\Mapper;

use App\Domains\Appointment\Entities\Appointment\AppointmentEntity;
use App\Models\Appointment;

class AppointmentMapper
{
    public static function toEntity(Appointment $appointment): AppointmentEntity
    {
        return AppointmentEntity::reconstitute([
            'id'               => $appointment->id,
            'doctor_id'        => $appointment->doctor_id,
            'patient_id'       => $appointment->patient_id,
            'department_id'    => $appointment->department_id,
            'appointment_date' => $appointment->appointment_date,
            'start_time'       => $appointment->start_time,
            'end_time'         => $appointment->end_time,
            'status'           => $appointment->status,
            'reason'           => $appointment->reason,
            'notes'            => $appointment->notes,
            'created_by'       => $appointment->created_by,
            'created_at'       => $appointment->created_at,
            'updated_at'       => $appointment->updated_at,
            'deleted_at'       => $appointment->deleted_at,
        ]);
    }
}
