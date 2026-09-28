<?php

namespace App\Models;

use App\Domains\Doctor\Database\Factories\DoctorFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;

#[Fillable([
    'user_id',
    'department_id',
    'license_number',
    'specialization',
    'phone',
    'email',
    'bio',
    'is_active',
    'created_by',
])]
class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected static function newFactory()
    {
        return DoctorFactory::new();
    }
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
