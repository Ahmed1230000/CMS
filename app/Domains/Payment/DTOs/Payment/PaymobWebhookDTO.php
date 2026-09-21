<?php

namespace App\Domains\Payment\DTOs\Payment;

final class PaymobWebhookDTO
{
    public function __construct(
        public readonly string $type,
        public readonly array $transaction,
        public readonly string $hmac,
    ) {}

    public static function fromArray(
        array $data,
        string $hmac,
    ): self {
        return new self(
            type: $data['type'],
            transaction: $data['obj'],
            hmac: $hmac,
        );
    }
}