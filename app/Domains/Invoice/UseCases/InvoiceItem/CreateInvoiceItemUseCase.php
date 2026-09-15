<?php

namespace App\Domains\Invoice\UseCases\InvoiceItem;

use App\Domains\Invoice\DTOs\InvoiceItem\InvoiceItemDTO;
use App\Domains\Invoice\Entities\InvoiceItem\InvoiceItemEntity;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Invoice\Repositories\Contracts\InvoiceItem\InvoiceItemRepositoryInterface;
use App\Domains\Invoice\Services\Invoice\InvoiceService;
use App\Domains\Pharmacy\Repositories\Contracts\MedicineItem\MedicineItemRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

class CreateInvoiceItemUseCase
{
    public function __construct(
        protected InvoiceItemRepositoryInterface $repository,
        protected MedicineItemRepositoryInterface $medicineItemRepositoryInterface,
        protected InvoiceRepositoryInterface $invoiceRepository,
        protected InvoiceService $invoiceService,
    ) {}

    public function execute(
        InvoiceItemDTO $dto,
        int $invoiceId
    ): InvoiceItemEntity {
        return DB::transaction(function () use ($dto, $invoiceId) {

            $medicineItem = $this->medicineItemRepositoryInterface->find(
                $dto->medicineItemId
            );

            if (is_null($medicineItem)) {
                throw new Exception('Medicine item not found');
            }

            $invoiceItem = InvoiceItemEntity::create(
                invoiceId: $invoiceId,
                medicineItemId: $dto->medicineItemId,
                quantity: $dto->quantity,
                unitPrice: $medicineItem->selling_price,
            );

            $invoiceItem = $this->repository->create($invoiceItem);

            $invoice = $this->invoiceRepository->find($invoiceId);

            $totals = $this->invoiceService->calculate($invoice);

            $this->invoiceRepository->updateTotals(
                $invoiceId,
                $totals
            );

            return $invoiceItem;
        });
    }
}
