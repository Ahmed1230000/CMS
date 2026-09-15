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
        public readonly ?Carbon $paidAt,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function create(
        int $invoiceId,
        int $createdBy,
        PaymentMethodEnum $method,
        float $amount,
        PaymentStatusEnum $status = PaymentStatusEnum::PAID,
        ?string $transactionId = null,
        ?Carbon $paidAt = null,
    ): self {
        return new self(
            id: null,
            invoiceId: $invoiceId,
            createdBy: $createdBy,
            method: $method,
            amount: $amount,
            status: $status,
            transactionId: $transactionId,
            paidAt: $paidAt ?? now(),
            created_at: now(),
            updated_at: now(),
        );
    }

    public static function reconstitute(
        int $id,
        int $invoiceId,
        int $createdBy,
        PaymentMethodEnum $method,
        float $amount,
        PaymentStatusEnum $status,
        ?string $transactionId,
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
            paidAt: $paidAt,
            created_at: $created_at,
            updated_at: $updated_at,
        );
    }
}