<?php

namespace App\Models;

use App\Domains\Invoice\Database\Factories\InvoiceItemFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Override;

#[Fillable(
    'invoice_id',
    'medicine_item_id',
    'quantity',
    'unit_price',
    'total',
)]
class InvoiceItem extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return InvoiceItemFactory::new();
    }
    protected $casts = [
        'invoice_id'       => 'integer',
        'medicine_item_id' => 'integer',
        'quantity'         => 'integer',
        'unit_price'       => 'decimal:2',
        'total'            => 'decimal:2',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function medicineItem()
    {
        return $this->belongsTo(MedicineItem::class);
    }
}
