<?php

namespace App\Domains\Payment\UseCases\Payment;

use App\Domains\Invoice\Exceptions\Invoice\InvoiceNotPayableException;
use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Invoice\Services\Invoice\InvoiceService;
use App\Domains\Payment\DTOs\Payment\PaymentDTO;
use App\Domains\Payment\Entities\Payment\PaymentEntity;
use App\Domains\Payment\Repositories\Contracts\Payment\PaymentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreatePaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $repository,
        protected InvoiceRepositoryInterface $invoiceRepositoryInterface,
        protected InvoiceService $invoiceService,
    ) {}

    public function execute(int $invoiceId, PaymentDTO $dto)
    {
        // TODO: implement business logic

        return  DB::transaction(function () use ($invoiceId, $dto) {

            $invoiceEntity = $this->invoiceRepositoryInterface->findByEntity($invoiceId);

            if (!$invoiceEntity->canReceivePayment()) {

                throw new InvoiceNotPayableException('This invoice cannot receive payment.');
            }

            $invoice = $this->invoiceRepositoryInterface->find($invoiceId);

            $paymentImpact = $this->invoiceService->calculatePaymentImpact($invoice, $dto->amount);

            $payment = PaymentEntity::create(

                invoiceId: $invoiceId,
                createdBy: auth()->id(),
                method: $dto->method,
                amount: $dto->amount,

            );

            $payment = $this->repository->create($payment);

            $this->invoiceRepositoryInterface->updatePaymentState($invoiceId, $paymentImpact);

            return $payment;
        });
    }
}
