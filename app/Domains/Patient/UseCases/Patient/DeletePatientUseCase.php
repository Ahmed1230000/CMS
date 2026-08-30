<?php

namespace App\Domains\Patient\UseCases\Patient;

use App\Domains\Patient\DTOs\Patient\PatientDTO;
use App\Domains\Patient\Repositories\Contracts\Patient\PatientRepositoryInterface;

class DeletePatientUseCase
{
    public function __construct(
        protected PatientRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository->delete($id);
    }
}
