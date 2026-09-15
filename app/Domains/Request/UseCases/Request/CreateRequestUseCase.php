<?php

namespace App\Domains\Request\UseCases\Request;

use App\Domains\Request\DTOs\Request\RequestDTO;
use App\Domains\Request\Entities\Request\RequestEntity;
use App\Domains\Request\Repositories\Contracts\Request\RequestRepositoryInterface;

class CreateRequestUseCase
{
    public function __construct(
        protected RequestRepositoryInterface $repository
    ) {}

    public function execute(RequestDTO $dto): RequestEntity
    {
        // TODO: implement business logic
        $request = RequestEntity::create([
            'type'   => $dto->type,
            'reason' => $dto->reason
        ]);
        return  $this->repository->create($request);
    }
}
