<?php

namespace App\Models;

use App\Domains\Payment\Enums\PaymentMethodEnum;
use App\Domains\Payment\Enums\PaymentStatusEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


#[Fillable(
    'invoice_id',
    'method',
    'amount',
    'status',
    'transaction_id',
    'paid_at',
    'created_by',
)]
class Payment extends Model
{

    protected $casts = [
        'invoice_id' => 'integer',
        'method'     => PaymentMethodEnum::class,
        'status'     => PaymentStatusEnum::class,
        'amount'     => 'decimal:2',
        'paid_at'    => 'datetime',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
