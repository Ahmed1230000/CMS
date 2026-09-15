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
            'invoice_id'     => $paymentEntity->invoiceId,
            'created_by'     => $paymentEntity->createdBy,
            'method'         => $paymentEntity->method,
            'amount'         => $paymentEntity->amount,
            'status'         => $paymentEntity->status,
            'transaction_id' => $paymentEntity->transactionId,
            'paid_at'        => $paymentEntity->paidAt,
        ]);

        return PaymentMapper::toEntity($payment);
    }
}
