<?php

namespace App\Infrastructure\QueryBuilder\Invoice;

use App\Infrastructure\BaseQueryBuilder;
use App\Models\Invoice;
use Spatie\QueryBuilder\QueryBuilder;

class InvoiceQueryBuilder extends BaseQueryBuilder
{
    protected string $model = Invoice::class;

    protected array $allowedIncludes = [
        'patient',
        'prescription',
    ];

    protected array $allowedFilters = [
        'patient_id',
        'prescription_id',
        'type',
        'status',
    ];

    protected array $allowedSorts = [
        'id',
        'invoice_number',
        'subtotal',
        'total',
        'paid_amount',
        'remaining_amount',
        'created_at',
        'updated_at',
    ];

    public function queryIndex(): QueryBuilder
    {
        return $this->query()
            ->select([
                'id',
                'invoice_number',
                'patient_id',
                'type',
                'status',
                'total',
                'paid_amount',
                'remaining_amount',
                'created_at',
            ])
            ->with([
                'patient:id,name',
            ]);
    }

    public function queryShow(int $id)
    {
        return $this->query()
            ->select([
                'id',
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
                'created_at',
                'updated_at',
            ])
            ->with([
                'patient:id,name,phone,email',
                'prescription:id,patient_id',
            ])
            ->where('id', $id)
            ->firstOrFail();
    }
}
