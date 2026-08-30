<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'patient_number',
    'name',
    'phone',
    'email',
    'gender',
    'date_of_birth',
    'national_id',
    'address',
    'is_active',
    'created_by',
    'user_id'
])]
class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
