<?php

namespace App\Domains\Doctor\UseCases\Doctor;

use App\Domains\Doctor\DTOs\Doctor\DoctorDTO;
use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;

class DeleteDoctorUseCase
{
    public function __construct(
        protected DoctorRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository->delete($id);
    }
}
