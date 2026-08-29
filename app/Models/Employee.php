<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'user_id',
    'employee_number',
    'name',
    'phone',
    'email',
    'gender',
    'date_of_birth',
    'national_id',
    'address',
    'hire_date',
    'job_title',
    'is_active',
    'created_by',
])]
class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'date_of_birth' => 'date',
        'hire_date'     => 'date',
        'is_active'     => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
