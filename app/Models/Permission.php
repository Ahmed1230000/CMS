<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'guard_name'])]

class Permission extends Model
{
    protected function casts()
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime'
        ];
    }
}
