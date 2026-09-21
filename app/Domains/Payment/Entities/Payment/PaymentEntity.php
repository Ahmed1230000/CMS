<?php

namespace App\Domains\Payment\Entities\Payment;

use App\Domains\Payment\Enums\PaymentMethodEnum;
use App\Domains\Payment\Enums\PaymentStatusEnum;
use Carbon\Carbon;

class PaymentEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $invoiceId,
        public readonly int $createdBy,
        public readonly PaymentMethodEnum $method,
        public readonly float $amount,
        public readonly PaymentStatusEnum $status,
        public readonly ?string $transactionId,

        public readonly ?string $paymobIntentionId,
        public readonly ?int $paymobOrderId,
        public readonly ?int $paymobTransactionId,

        public readonly ?Carbon $paidAt,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function create(
        int $invoiceId,
        int $createdBy,
        PaymentMethodEnum $method,
        float $amount,
        ?string $transactionId = null,
        ?string $paymobIntentionId = null,
        ?int $paymobOrderId = null,
        ?int $paymobTransactionId = null,
        ?Carbon $paidAt = null,
    ): self {
        $status = $method->initialStatus();

        return new self(
            id: null,
            invoiceId: $invoiceId,
            createdBy: $createdBy,
            method: $method,
            amount: $amount,
            status: $status,
            transactionId: $transactionId,
            paymobIntentionId: $paymobIntentionId,
            paymobOrderId: $paymobOrderId,
            paymobTransactionId: $paymobTransactionId,
            paidAt: $status === PaymentStatusEnum::PAID
                ? ($paidAt ?? now())
                : null,
            created_at: now(),
            updated_at: now(),
        );
    }
    public function isPaid(): bool
    {
        return $this->status === PaymentStatusEnum::PAID;
    }

    public static function reconstitute(
        int $id,
        int $invoiceId,
        int $createdBy,
        PaymentMethodEnum $method,
        float $amount,
        PaymentStatusEnum $status,
        ?string $transactionId,
        ?string $paymobIntentionId,
        ?int $paymobOrderId,
        ?int $paymobTransactionId,
        ?Carbon $paidAt,
        Carbon $created_at,
        Carbon $updated_at,
    ): self {
        return new self(
            id: $id,
            invoiceId: $invoiceId,
            createdBy: $createdBy,
            method: $method,
            amount: $amount,
            status: $status,
            transactionId: $transactionId,
            paymobIntentionId: $paymobIntentionId,
            paymobOrderId: $paymobOrderId,
            paymobTransactionId: $paymobTransactionId,
            paidAt: $paidAt,
            created_at: $created_at,
            updated_at: $updated_at,
        );
    }

    public function markAsPaid(
        ?int $paymobTransactionId = null,
        ?Carbon $paidAt = null,
    ): self {
        return new self(
            id: $this->id,
            invoiceId: $this->invoiceId,
            createdBy: $this->createdBy,
            method: $this->method,
            amount: $this->amount,
            status: PaymentStatusEnum::PAID,
            transactionId: $this->transactionId,
            paymobIntentionId: $this->paymobIntentionId,
            paymobOrderId: $this->paymobOrderId,
            paymobTransactionId: $paymobTransactionId ?? $this->paymobTransactionId,
            paidAt: $paidAt ?? now(),
            created_at: $this->created_at,
            updated_at: now(),
        );
    }

    public function markAsFailed(
        ?int $paymobTransactionId = null,
    ): self {
        return new self(
            id: $this->id,
            invoiceId: $this->invoiceId,
            createdBy: $this->createdBy,
            method: $this->method,
            amount: $this->amount,
            status: PaymentStatusEnum::FAILED,
            transactionId: $this->transactionId,
            paymobIntentionId: $this->paymobIntentionId,
            paymobOrderId: $this->paymobOrderId,
            paymobTransactionId: $paymobTransactionId ?? $this->paymobTransactionId,
            paidAt: null,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }
}
