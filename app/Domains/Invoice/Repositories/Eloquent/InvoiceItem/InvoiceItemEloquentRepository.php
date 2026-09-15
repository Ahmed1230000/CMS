<?php

namespace App\Domains\Invoice\Repositories\Eloquent\InvoiceItem;

use App\Domains\Invoice\DTOs\InvoiceItem\IndexInvoiceItemDTO;
use App\Domains\Invoice\DTOs\InvoiceItem\ShowInvoiceItemDTO;
use App\Domains\Invoice\Entities\InvoiceItem\InvoiceItemEntity;
use App\Domains\Invoice\Mapper\InvoiceItemMapper;
use App\Domains\Invoice\Repositories\Contracts\InvoiceItem\InvoiceItemRepositoryInterface;
use App\Infrastructure\QueryBuilder\InvoiceItem\InvoiceItemQueryBuilder;
use App\Models\InvoiceItem;

class InvoiceItemEloquentRepository implements InvoiceItemRepositoryInterface
{
    public function index(int $id)
    {
        return (new InvoiceItemQueryBuilder())
            ->queryIndex($id)
            ->paginate()
            ->through(function ($invoiceItem) {
                return IndexInvoiceItemDTO::fromArray([
                    'id' => $invoiceItem->id,
                    'medicine_item_name' => $invoiceItem->medicineItem?->name,
                    'medicine_code' => $invoiceItem->medicineItem?->code,
                    'quantity' => $invoiceItem->quantity,
                    'unit_price' => $invoiceItem->unit_price,
                    'total' => $invoiceItem->total,
                ]);
            });
    }

    public function show(int $id)
    {
        $invoiceItem = (new InvoiceItemQueryBuilder())->queryShow($id);
        return ShowInvoiceItemDTO::fromArray([
            'id'                 => $invoiceItem->id,
            'medicine_item_name' => $invoiceItem->medicineItem?->name,
            'medicine_code'      => $invoiceItem->medicineItem?->code,
            'quantity'           => $invoiceItem->quantity,
            'unit_price'         => $invoiceItem->unit_price,
            'total'              => $invoiceItem->total,
        ]);
    }

    public function create(InvoiceItemEntity $invoiceItemEntity): InvoiceItemEntity
    {
        $invoiceItem = InvoiceItem::create([
            'id'               => $invoiceItemEntity->id,
            'invoice_id'       => $invoiceItemEntity->invoiceId,
            'medicine_item_id' => $invoiceItemEntity->medicineItemId,
            'quantity'         => $invoiceItemEntity->quantity,
            'unit_price'       => $invoiceItemEntity->unitPrice,
            'total'            => $invoiceItemEntity->total,
        ]);
        return InvoiceItemMapper::toEntity($invoiceItem);
    }
    public function update(InvoiceItemEntity $invoiceItemEntity): InvoiceItemEntity
    {
        $invoiceItem = InvoiceItem::findOrFail($invoiceItemEntity->id);
        $invoiceItem->update([
            'quantity' => $invoiceItemEntity->quantity,
            'total' => $invoiceItemEntity->total,
        ]);

        return InvoiceItemMapper::toEntity($invoiceItem);
    }
    public function find(int $id): InvoiceItemEntity
    {
        $invoiceItem = InvoiceItem::findOrFail($id);
        return InvoiceItemMapper::toEntity($invoiceItem);
    }


    public function delete(int $id)
    {
        $invoiceItem = InvoiceItem::findOrFail($id);
        $invoiceItem->delete();
    }
}
