<?php

namespace App\Domains\Invoice\UseCases\IndexInvoiceItemUseCase;

use App\Domains\Invoice\Repositories\Contracts\InvoiceItem\InvoiceItemRepositoryInterface;
use App\Domains\Invoice\DTOs\InvoiceItem\IndexInvoiceItemDTO;

class IndexInvoiceItemUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private InvoiceItemRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $id)
    {
        return $this->repository->index($id);
    }
}
