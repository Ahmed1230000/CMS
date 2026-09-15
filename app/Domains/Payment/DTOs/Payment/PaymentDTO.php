<?php

namespace App\Domains\Payment\DTOs\Payment;

use App\Domains\Payment\Enums\PaymentMethodEnum;

class PaymentDTO
{
    public function __construct(
        public readonly PaymentMethodEnum $method,
        public readonly float $amount,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            method: $data['method'],
            amount: (float) $data['amount'],
        );
    }

    public function toArray(): array
    {
        return [
            'method' => $this->method,
            'amount' => $this->amount,
        ];
    }
}
