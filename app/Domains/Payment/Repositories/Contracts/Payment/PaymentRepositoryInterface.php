<?php

namespace App\Domains\Payment\Repositories\Contracts\Payment;

use App\Domains\Payment\Entities\Payment\PaymentEntity;

interface PaymentRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function create(PaymentEntity $paymentEntity): PaymentEntity;
}
