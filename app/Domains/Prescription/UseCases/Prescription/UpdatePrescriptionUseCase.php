<?php

namespace App\Domains\Prescription\UseCases\Prescription;

use App\Domains\Prescription\DTOs\Prescription\PrescriptionDTO;
use App\Domains\Prescription\Repositories\Contracts\Prescription\PrescriptionRepositoryInterface;

class UpdatePrescriptionUseCase
{
    public function __construct(
        protected PrescriptionRepositoryInterface $repository
    ) {}

    public function execute(PrescriptionDTO $dto): PrescriptionDTO
    {
        // TODO: implement business logic
        $this->repository;

        return $dto;
    }
}