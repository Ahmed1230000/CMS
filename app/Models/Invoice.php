<?php

namespace App\Models;

use App\Domains\Invoice\Enums\{
    InvoiceStatusEnum,
    InvoiceTypeEnum
};
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(
    'invoice_number',
    'patient_id',
    'prescription_id',
    'type',
    'status',
    'subtotal',
    'discount',
    'tax',
    'total',
    'paid_amount',
    'remaining_amount',
)]
class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoices';

    protected $casts = [
        'type'             => InvoiceTypeEnum::class,
        'status'           => InvoiceStatusEnum::class,
        'subtotal'         => 'decimal:2',
        'discount'         => 'decimal:2',
        'tax'              => 'decimal:2',
        'total'            => 'decimal:2',
        'paid_amount'      => 'decimal:2',
        'remaining_amount' => 'decimal:2',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    // public function payments()
    // {
    //     return $this->hasMany(Payment::class);
    // }
}
