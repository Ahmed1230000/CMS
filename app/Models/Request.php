<?php

namespace App\Models;

use App\Domains\Request\Enums\RequestStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(
    'requester_id',
    'type',
    'status',
    'reason',
    'approved_by',
    'approved_at',
    'rejected_by',
    'rejected_at',
)]
class Request extends Model
{
    protected $table = 'requests';

    protected $casts = [
        'status'      => RequestStatusEnum::class,
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function requester(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function rejectedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
