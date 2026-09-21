<?php

namespace App\Domains\Payment\Repositories\Contracts\Payment;

use App\Domains\Payment\Entities\Payment\PaymentEntity;
use App\Models\Payment;

interface PaymentRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function create(PaymentEntity $paymentEntity): PaymentEntity;

    public function update(PaymentEntity $paymentEntity): PaymentEntity;

    public function where(array|string $columns, mixed $target): ?Payment;

    public function find(int $id);
}
