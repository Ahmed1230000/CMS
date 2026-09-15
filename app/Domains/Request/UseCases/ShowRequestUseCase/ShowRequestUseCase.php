<?php

namespace App\Domains\Request\UseCases\ShowRequestUseCase;

use App\Domains\Request\Repositories\Contracts\Request\RequestRepositoryInterface;
use App\Domains\Request\DTOs\Request\RequestShowDTO;

class ShowRequestUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private RequestRepositoryInterface $repository
    ) {}

    /*
    |--------------------------------------------------------------------------
    | Handle
    |--------------------------------------------------------------------------
    */

    public function execute(int $id)
    {
        return $this->repository->show($id);
    }
}
