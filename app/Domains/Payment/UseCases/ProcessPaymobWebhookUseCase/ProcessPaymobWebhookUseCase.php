<?php

namespace App\Domains\Payment\UseCases\ProcessPaymobWebhookUseCase;

use App\Domains\Invoice\Repositories\Contracts\Invoice\InvoiceRepositoryInterface;
use App\Domains\Invoice\Services\Invoice\InvoiceService;
use App\Domains\Payment\DTOs\Payment\PaymobWebhookDTO;
use App\Domains\Payment\Exceptions\Payment\InvalidPaymobHMACException;
use App\Domains\Payment\Exceptions\Payment\InvalidPaymobWebhookException;
use App\Domains\Payment\Mapper\PaymentMapper;
use App\Domains\Payment\Repositories\Contracts\Payment\PaymentRepositoryInterface;
use App\Domains\Payment\Services\Paymob\PaymobHmacVerifier;
use Illuminate\Support\Facades\DB;

class ProcessPaymobWebhookUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private InvoiceRepositoryInterface $repository,
        private PaymentRepositoryInterface $paymentRepositoryInterface,
        private PaymobHmacVerifier $paymobHmacVerifier,
        private InvoiceService $invoiceService,
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(PaymobWebhookDTO $dto): void
    {
        $isValid = $this->paymobHmacVerifier->verify(
            $dto->transaction,
            $dto->hmac
        );

        if (! $isValid) {
            throw new InvalidPaymobHMACException(
                'Invalid Paymob HMAC.'
            );
        }

        if ($dto->type !== 'TRANSACTION') {
            throw new InvalidPaymobWebhookException(
                'Invalid Paymob callback type.'
            );
        }

        $paymobOrderId = $dto->transaction['order']['id'];

        $payment = $this->paymentRepositoryInterface->where(
            'paymob_order_id',
            $paymobOrderId
        );

        if (! $payment) {
            throw new InvalidPaymobWebhookException(
                'Paymob order ID does not match.'
            );
        }

        $paymentEntity = PaymentMapper::toEntity($payment);

        if ($paymentEntity->isPaid()) {
            return;
        }
        $paymobAmount = (int) $dto->transaction['amount_cents'];
        $paymentAmount = (int) round($paymentEntity->amount * 100);

        if ($paymobAmount !== $paymentAmount) {
            throw new InvalidPaymobWebhookException(
                'Payment amount does not match.'
            );
        }

        $paymobCurrency = $dto->transaction['currency'];
        $expectedCurrency = config('services.paymob.currency');

        if ($paymobCurrency !== $expectedCurrency) {
            throw new InvalidPaymobWebhookException(
                'Payment currency does not match.'
            );
        }

        $paymobIntegrationId = (int) $dto->transaction['integration_id'];
        $paymentIntegrationId = (int) config(
            'services.paymob.card_integration_id'
        );

        if ($paymobIntegrationId !== $paymentIntegrationId) {
            throw new InvalidPaymobWebhookException(
                'Payment Integration ID does not match.'
            );
        }

        $transactionId = $dto->transaction['id'] ?? null;

        if (! $transactionId) {
            throw new InvalidPaymobWebhookException(
                'Paymob transaction ID is missing.'
            );
        }

        if ($dto->transaction['pending'] === true) {
            return;
        }

        if ($dto->transaction['success'] === false) {
            $paymentEntity = $paymentEntity->markAsFailed($transactionId);

            $this->paymentRepositoryInterface->update(
                $paymentEntity
            );

            return;
        }

        $invoiceEntity = $this->repository->findByEntity(
            $paymentEntity->invoiceId
        );

        if (! $invoiceEntity->canReceivePayment()) {
            throw new InvalidPaymobWebhookException(
                'Invoice cannot receive payment.'
            );
        }

        DB::transaction(function () use (
            $paymentEntity,
            $transactionId,
        ) {
            $paymentEntity = $paymentEntity->markAsPaid(
                (int) $transactionId
            );

            $this->paymentRepositoryInterface->update(
                $paymentEntity
            );

            $invoice = $this->repository->find(
                $paymentEntity->invoiceId
            );

            $paymentImpact = $this->invoiceService->calculatePaymentImpact(
                $invoice,
                $paymentEntity->amount
            );

            $this->repository->updatePaymentState(
                $paymentEntity->invoiceId,
                $paymentImpact
            );
        });
    }
}
