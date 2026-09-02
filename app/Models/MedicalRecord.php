<?php

namespace App\Models;

use App\Domains\MedicalRecord\Enums\MedicalRecordStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'patient_id',
    'chief_complaint',
    'diagnosis',
    'clinical_notes',
    'treatment_plan',
    'status',
    'created_by',
])]
class MedicalRecord extends Model
{
    use SoftDeletes;
    protected $table = 'medical_records';

    protected $casts = [
        'status'         => MedicalRecordStatusEnum::class,
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'created_by'     => 'integer',
        'deleted_at'     => 'datetime',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
