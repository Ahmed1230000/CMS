<?php

namespace App\Domains\Payment\UseCases\CreateCardPaymentUseCase;

use App\Domains\Invoice\Exceptions\Invoice\InvoiceNotPayableException;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Invoice\Services\Invoice\InvoiceService;
use App\Domains\Payment\DTOs\Payment\PaymentDTO;
use App\Domains\Payment\Entities\Payment\PaymentEntity;
use App\Domains\Payment\Repositories\Contracts\Payment\PaymentRepositoryInterface;
use App\Domains\Payment\Services\Paymob\PaymobService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateCardPaymentUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private PaymentRepositoryInterface $repository,
        protected InvoiceRepositoryInterface $invoiceRepositoryInterface,
        protected PaymobService $paymobService,
        protected InvoiceService $invoiceService,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $invoiceId, PaymentDTO $dto)
    {
        $invoiceEntity = $this->invoiceRepositoryInterface->findByEntity($invoiceId);

        if (!$invoiceEntity) {
            throw new InvoiceNotPayableException('This invoice cannot receive payment.');
        }

        $invoice = $this->invoiceRepositoryInterface->find($invoiceId);

        $this->invoiceService->calculatePaymentImpact($invoice, $dto->amount);

        $reference = (string) Str::uuid();

        $paymobData  = $this->paymobService->createPaymentIntention($dto->amount, $reference);

        $payment = PaymentEntity::create(
            invoiceId: $invoiceId,
            createdBy: auth()->id(),
            method: $dto->method,
            amount: $dto->amount,
            paymobIntentionId: $paymobData['paymob_intention_id'],
            paymobOrderId: $paymobData['paymob_order_id'],
        );

        $payment = $this->repository->create($payment);

        return [
            'payment' => $payment,
            'client_secret' => $paymobData['client_secret'],
        ];
    }
}
