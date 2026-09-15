<?php

namespace App\Domains\Invoice\UseCases\FinishInvoiceUseCase;

use App\Domains\Invoice\Entities\Invoice\InvoiceEntity;
use App\Domains\Invoice\Exceptions\Invoice\InvoiceCannotBeFinishedException;
use App\Domains\Invoice\Exceptions\Invoice\InvoiceItemsRequiredException;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FinishInvoiceUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private InvoiceRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $invoiceId): void
    {
        DB::transaction(function () use ($invoiceId) {

            $invoice = $this->repository->findByEntity($invoiceId);

            if (! $this->repository->hasItems($invoice->id)) {
                throw new InvoiceItemsRequiredException(
                    'Invoice must have at least one item.'
                );
            }
            if (! $invoice->canFinish()) {
                throw new InvoiceCannotBeFinishedException('This invoice cannot be finished.');
            }
            
            $this->repository->changeToUnpaid(
                $invoice->unPaid()
            );
        });
    }
}
