<?php

namespace App\Domains\Hr\UseCases\ListHrsUseCase;

use App\Domains\Hr\Repositories\Contracts\Hr\HrRepositoryInterface;


class ListHrsUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private HrRepositoryInterface $repository
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
