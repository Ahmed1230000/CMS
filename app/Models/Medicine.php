<?php

namespace App\Models;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(
    'code',
    'name',
    'generic_name',
    'manufacturer',
    'status',
    'created_by'
)]
class Medicine extends Model
{
    protected $table = 'medicines';

    protected $casts = [
        'status' => MedicineStatusEnum::class,
    ];


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
