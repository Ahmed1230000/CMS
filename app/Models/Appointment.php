<?php

namespace App\Models;

use App\Domains\Appointment\Enums\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'doctor_id',
    'patient_id',
    'department_id',
    'appointment_date',
    'start_time',
    'end_time',
    'status',
    'reason',
    'notes',
    'created_by',
])]
class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'appointment_date' => 'date',

        'start_time' => 'datetime:H:i',

        'end_time' => 'datetime:H:i',

        'status' => AppointmentStatusEnum::class,

        'created_at' => 'datetime',

        'updated_at' => 'datetime',

        'deleted_at' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(
            Doctor::class,
            'doctor_id'
        );
    }

    public function patient()
    {
        return $this->belongsTo(
            Patient::class,
            'patient_id'
        );
    }

    public function department()
    {
        return $this->belongsTo(
            Department::class,
            'department_id'
        );
    }

    public function creator()
    {
        return $this->belongsTo(
            User::class,
            'created_by'
        );
    }
}
