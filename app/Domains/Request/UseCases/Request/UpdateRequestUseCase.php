<?php

namespace App\Domains\Request\UseCases\Request;

use App\Domains\Request\DTOs\Request\RequestDTO;
use App\Domains\Request\Entities\Request\RequestEntity;
use App\Domains\Request\Repositories\Contracts\Request\RequestRepositoryInterface;

class UpdateRequestUseCase
{
    public function __construct(
        protected RequestRepositoryInterface $repository
    ) {}

    public function execute(
        RequestEntity $requestEntity,
        RequestDTO $dto,
    ): RequestEntity {
        $request = $requestEntity->update([
            'type' => $dto->type,
            'reason' => $dto->reason,
        ]);

        return $this->repository->update($request);
    }
}
