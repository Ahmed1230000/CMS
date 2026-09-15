<?php

namespace App\Domains\Invoice\UseCases\ShowInvoiceItemUseCase;

use App\Domains\Invoice\Repositories\Contracts\InvoiceItem\InvoiceItemRepositoryInterface;
use App\Domains\Invoice\DTOs\InvoiceItem\ShowInvoiceItemDTO;

class ShowInvoiceItemUseCase
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
        return $this->repository->show($id);
    }
}
