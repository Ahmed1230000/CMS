<?php

namespace App\Domains\Prescription\UseCases\Prescription;

use App\Domains\Prescription\DTOs\Prescription\PrescriptionDTO;
use App\Domains\Prescription\Repositories\Contracts\Prescription\PrescriptionRepositoryInterface;

class DeletePrescriptionUseCase
{
    public function __construct(
        protected PrescriptionRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}