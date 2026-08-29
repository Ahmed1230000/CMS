<?php

namespace App\Domains\Hr\UseCases\Hr;

use App\Domains\Hr\DTOs\Hr\HrDTO;
use App\Domains\Hr\Repositories\Contracts\Hr\HrRepositoryInterface;

class DeleteHrUseCase
{
    public function __construct(
        protected HrRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository->delete($id);

    }
}