<?php

namespace App\Models;

use App\Domains\pharmacy\Database\Factories\MedicineFactory;
use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

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
    use HasFactory;
    protected $table = 'medicines';

    protected static function newFactory()
    {
        return MedicineFactory::new();
    }

    protected $casts = [
        'status' => MedicineStatusEnum::class,
    ];


    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
