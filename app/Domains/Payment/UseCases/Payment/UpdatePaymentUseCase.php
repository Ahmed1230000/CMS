<?php

namespace App\Domains\Payment\UseCases\Payment;

use App\Domains\Payment\DTOs\Payment\PaymentDTO;
use App\Domains\Payment\Repositories\Contracts\Payment\PaymentRepositoryInterface;

class UpdatePaymentUseCase
{
    public function __construct(
        protected PaymentRepositoryInterface $repository
    ) {}

    public function execute(PaymentDTO $dto): PaymentDTO
    {
        // TODO: implement business logic
        $this->repository;

        return $dto;
    }
}