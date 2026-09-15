<?php

namespace App\Models;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(
    'medicine_id',
    'code',
    'name',
    'strength',
    'dosage_form',
    'unit',
    'barcode',
    'status',
    'created_by',
    'selling_price',
)]
class MedicineItem extends Model
{
    protected $casts = [
        'status' => MedicineStatusEnum::class,
    ];

    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
