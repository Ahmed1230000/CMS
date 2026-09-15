<?php

namespace App\Domains\Invoice\UseCases\InvoiceItem;

use App\Domains\Invoice\DTOs\InvoiceItem\UpdateInvoiceItemDTO;
use App\Domains\Invoice\Entities\InvoiceItem\InvoiceItemEntity;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Invoice\Repositories\Contracts\InvoiceItem\InvoiceItemRepositoryInterface;
use App\Domains\Invoice\Services\Invoice\InvoiceService;
use Illuminate\Support\Facades\DB;

class UpdateInvoiceItemUseCase
{
    public function __construct(
        protected InvoiceItemRepositoryInterface $repository,
        protected InvoiceRepositoryInterface $invoiceRepositoryInterface,
        protected InvoiceService $invoiceService,
    ) {}

    public function execute(int $id, UpdateInvoiceItemDTO $dto): InvoiceItemEntity
    {
        return DB::transaction(function () use ($id, $dto) {
            $invoiceItem = $this->repository->find($id);

            $invoiceId = $invoiceItem->invoiceId;

            $updatedInvoiceItem = $invoiceItem->update(
                $dto->quantity
            );

            $invoiceItem =  $this->repository->update($updatedInvoiceItem);

            $invoice = $this->invoiceRepositoryInterface->find($invoiceId);

            $total = $this->invoiceService->calculate($invoice);

            $this->invoiceRepositoryInterface->updateTotals($invoiceId, $total);

            return $invoiceItem;
        });
    }
}
