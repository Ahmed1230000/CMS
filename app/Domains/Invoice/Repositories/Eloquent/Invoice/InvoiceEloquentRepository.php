<?php

namespace App\Domains\Invoice\Repositories\Eloquent\Invoice;

use App\Domains\Invoice\DTOs\Invoice\IndexInvoiceDTO;
use App\Domains\Invoice\DTOs\Invoice\ShowInvoiceDTO;
use App\Domains\Invoice\Entities\Invoice\InvoiceEntity;
use App\Domains\Invoice\Mapper\InvoiceMapper;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Infrastructure\QueryBuilder\Invoice\InvoiceQueryBuilder;
use App\Models\Invoice;

class InvoiceEloquentRepository implements InvoiceRepositoryInterface
{
    public function index()
    {
        return (new InvoiceQueryBuilder())->queryIndex()->paginate(10)->through(
            function ($invoice) {
                return IndexInvoiceDTO::fromArray([
                    'id'               => $invoice->id,
                    'invoice_number'   => $invoice->invoice_number,
                    'patient_name'     => $invoice->patient?->name,
                    'type'             => $invoice->type,
                    'status'           => $invoice->status,
                    'total'            => $invoice->total,
                    'paid_amount'      => $invoice->paid_amount,
                    'remaining_amount' => $invoice->remaining_amount,
                    'created_at'       => $invoice->created_at,
                ]);
            }
        );
    }

    public function show(int $id)
    {
        $invoice = (new InvoiceQueryBuilder())->queryShow($id);

        return ShowInvoiceDTO::fromArray([
            'id' => $invoice->id,
            'invoice_number' => $invoice->invoice_number,

            'patient_id' => $invoice->patient_id,
            'patient_name' => $invoice->patient?->name,
            'patient_phone' => $invoice->patient?->phone,
            'patient_email' => $invoice->patient?->email,

            'prescription_id' => $invoice->prescription_id,

            'type' => $invoice->type,
            'status' => $invoice->status,

            'subtotal' => $invoice->subtotal,
            'discount' => $invoice->discount,
            'tax' => $invoice->tax,
            'total' => $invoice->total,

            'paid_amount' => $invoice->paid_amount,
            'remaining_amount' => $invoice->remaining_amount,

            'created_at' => $invoice->created_at,
            'updated_at' => $invoice->updated_at,
        ]);
    }

    public function create(InvoiceEntity $invoiceEntity): InvoiceEntity
    {
        $invoice = Invoice::create([
            'invoice_number'   => $invoiceEntity->invoiceNumber,
            'patient_id'       => $invoiceEntity->patientId,
            'prescription_id'  => $invoiceEntity->prescriptionId,
            'type'             => $invoiceEntity->type,
            'status'           => $invoiceEntity->status,
            'subtotal'         => $invoiceEntity->subtotal,
            'discount'         => $invoiceEntity->discount,
            'tax'              => $invoiceEntity->tax,
            'total'            => $invoiceEntity->total,
            'paid_amount'      => $invoiceEntity->paidAmount,
            'remaining_amount' => $invoiceEntity->remainingAmount,
        ]);

        return InvoiceMapper::toEntity($invoice);
    }

    public function insertInvoiceNumber(InvoiceEntity $invoiceEntity): InvoiceEntity
    {
        $invoice = Invoice::findOrFail($invoiceEntity->id);

        $updatedEntity = $invoiceEntity->withInvoiceNumber();

        $invoice->update([
            'invoice_number'   => $updatedEntity->invoiceNumber,
        ]);

        return InvoiceMapper::toEntity($invoice);
    }
    public function updateTotals(int $id, array $totals)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'subtotal'         => $totals['subtotal'],
            'discount'         => $totals['discount'],
            'tax'              => $totals['tax'],
            'total'            => $totals['total'],
            'remaining_amount' => $totals['remaining_amount'],
        ]);

        return $invoice;
    }

    public function find(int $id)
    {
        $invoice = Invoice::findOrFail($id);
        return $invoice;
    }
}
