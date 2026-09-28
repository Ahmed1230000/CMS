<?php

namespace App\Domains\Payment\Repositories\Eloquent\Payment;

use App\Domains\Payment\Entities\Payment\PaymentEntity;
use App\Domains\Payment\Mapper\PaymentMapper;
use App\Domains\Payment\Repositories\Contracts\Payment\PaymentRepositoryInterface;
use App\Models\Payment;

class PaymentEloquentRepository implements PaymentRepositoryInterface
{
    public function create(PaymentEntity $paymentEntity): PaymentEntity
    {
        $payment = Payment::create([
            'invoice_id'            => $paymentEntity->invoiceId,
            'created_by'            => $paymentEntity->createdBy,
            'method'                => $paymentEntity->method,
            'amount'                => $paymentEntity->amount,
            'status'                => $paymentEntity->status,
            'transaction_id'        => $paymentEntity->transactionId,
            'paymob_intention_id'   => $paymentEntity->paymobIntentionId,
            'paymob_order_id'       => $paymentEntity->paymobOrderId,
            'paymob_transaction_id' => $paymentEntity->paymobTransactionId,
            'paid_at'               => $paymentEntity->paidAt,
        ]);

        return PaymentMapper::toEntity($payment);
    }

    public function update(PaymentEntity $paymentEntity): PaymentEntity
    {
        $payment = Payment::findOrFail($paymentEntity->id);

        $payment->update([
            'status'                => $paymentEntity->status,
            'transaction_id'        => $paymentEntity->transactionId,
            'paymob_intention_id'   => $paymentEntity->paymobIntentionId,
            'paymob_order_id'       => $paymentEntity->paymobOrderId,
            'paymob_transaction_id' => $paymentEntity->paymobTransactionId,
            'paid_at'               => $paymentEntity->paidAt,
        ]);

        return PaymentMapper::toEntity($payment->fresh());
    }

    public function where(array|string $columns, mixed $target): ?Payment
    {
        return Payment::where($columns, $target)->first();
    }
    public function findForUpdateByPaymobOrderId(int $paymobOrderId): ?Payment
    {
        return Payment::query()->where('paymob_order_id', $paymobOrderId)->lockForUpdate()->first();
    }

    public function find(int $id)
    {
        return Payment::findOrFail($id)->first();
    }
}
