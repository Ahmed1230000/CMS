<?php

namespace App\Domains\Invoice\UseCases\Invoice;

use App\Domains\Invoice\DTOs\Invoice\InvoiceDTO;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;

class DeleteInvoiceUseCase
{
    public function __construct(
        protected InvoiceRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}