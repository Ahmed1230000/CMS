<?php

namespace App\Infrastructure\QueryBuilder\InvoiceItem;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\InvoiceItem;
use Spatie\QueryBuilder\QueryBuilder;

class InvoiceItemQueryBuilder extends BaseQueryBuilder
{
    protected string $model = InvoiceItem::class;

    protected array $allowedIncludes = [
        'invoice',
        'medicineItem',
    ];

    protected array $allowedFilters = [
        'invoice_id',
        'medicine_item_id',
    ];

    protected array $allowedSorts = [
        'id',
        'quantity',
        'unit_price',
        'total',
        'created_at',
        'updated_at',
    ];

    public function queryIndex(int $invoiceId): QueryBuilder
    {
        return $this->query()
            ->select([
                'id',
                'invoice_id',
                'medicine_item_id',
                'quantity',
                'unit_price',
                'total',
            ])
            ->with([
                'invoice:id,invoice_number,status,subtotal,discount,tax,total,paid_amount,remaining_amount',
                'medicineItem:id,medicine_id,name,code,strength,dosage_form,selling_price',
                'medicineItem.medicine:id,name',
            ])
            ->where('invoice_id', $invoiceId)
            ->orderBy('id');
    }

    public function queryShow(int $id): QueryBuilder
    {
        return $this->query()
            ->select([
                'id',
                'invoice_id',
                'medicine_item_id',
                'quantity',
                'unit_price',
                'total',
                'created_at',
                'updated_at',
            ])
            ->with([
                'medicineItem:id,name,code,strength,dosage_form,unit,selling_price',
                'invoice:id,invoice_number',
            ])
            ->where('id', $id)->firstOrFail();
    }
}
