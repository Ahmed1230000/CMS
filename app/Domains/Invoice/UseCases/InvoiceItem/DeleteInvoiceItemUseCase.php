<?php

namespace App\Domains\Invoice\UseCases\InvoiceItem;

use App\Domains\Invoice\DTOs\InvoiceItem\InvoiceItemDTO;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Invoice\Repositories\Contracts\InvoiceItem\InvoiceItemRepositoryInterface;
use App\Domains\Invoice\Services\Invoice\InvoiceService;
use Illuminate\Support\Facades\DB;

class DeleteInvoiceItemUseCase
{
    public function __construct(
        protected InvoiceItemRepositoryInterface $repository,
        protected InvoiceRepositoryInterface $invoiceRepositoryInterface,
        protected InvoiceService $invoiceService,
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic

        DB::transaction(function () use ($id) {
            $invoiceItem = $this->repository->find($id);

            $invoiceId = $invoiceItem->invoiceId;

            $this->repository->delete($id);

            $invoice = $this->invoiceRepositoryInterface->find($invoiceId);

            $total = $this->invoiceService->calculate($invoice);

            $this->invoiceRepositoryInterface->updateTotals($invoiceId, $total);
        });
    }
}
