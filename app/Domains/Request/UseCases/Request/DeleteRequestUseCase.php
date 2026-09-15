<?php

namespace App\Domains\Request\UseCases\Request;

use App\Domains\Request\DTOs\Request\RequestDTO;
use App\Domains\Request\Repositories\Contracts\Request\RequestRepositoryInterface;

class DeleteRequestUseCase
{
    public function __construct(
        protected RequestRepositoryInterface $repository
    ) {}

    public function execute(int $id)
    {
        // TODO: implement business logic
        $this->repository;

    }
}