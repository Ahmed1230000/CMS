<?php

namespace App\Domains\Payment\UseCases\Payment;

use App\Domains\Payment\DTOs\Payment\PaymentDTO;
use App\Domains\Payment\Repositories\Contracts\Payment\PaymentRepositoryInterface;

class DeletePaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}