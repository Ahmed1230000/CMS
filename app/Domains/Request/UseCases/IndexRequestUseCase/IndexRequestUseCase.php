<?php

namespace App\Domains\Request\UseCases\IndexRequestUseCase;

use App\Domains\Request\Repositories\Contracts\Request\RequestRepositoryInterface;
use App\Domains\Request\DTOs\Request\RequestIndexDTO;

class IndexRequestUseCase
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

    public function execute()
    {
        return $this->repository->index();
    }
}
