<?php

namespace App\Domains\Invoice\UseCases\Invoice;

use App\Domains\Invoice\DTOs\Invoice\InvoiceDTO;
use App\Domains\Invoice\Entities\Invoice\InvoiceEntity;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class CreateInvoiceUseCase
{
    public function __construct(
        protected InvoiceRepositoryInterface $repository
    ) {}

    public function execute()
    {
        // TODO: implement business logic

        return DB::transaction(function () {
            $invoice = InvoiceEntity::create();

            $invoice = $this->repository->create($invoice);

            return $this->repository->insertInvoiceNumber($invoice);
        });
    }
}
