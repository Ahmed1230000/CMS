<?php

namespace App\Domains\Payment\Mapper;

use App\Domains\Payment\Entities\Payment\PaymentEntity;
use App\Models\Payment;

class PaymentMapper
{
    public static function toEntity(Payment $payment): PaymentEntity
    {
        return PaymentEntity::reconstitute(
            id: $payment->id,
            invoiceId: $payment->invoice_id,
            createdBy: $payment->created_by,
            method: $payment->method,
            amount: (float) $payment->amount,
            status: $payment->status,
            transactionId: $payment->transaction_id,
            paidAt: $payment->paid_at,
            created_at: $payment->created_at,
            updated_at: $payment->updated_at,
        );
    }
}
