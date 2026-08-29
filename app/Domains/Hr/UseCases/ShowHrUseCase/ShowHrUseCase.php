<?php

namespace App\Domains\hr\UseCases\ShowHrUseCase;

use App\Domains\Hr\Repositories\Contracts\Hr\HrRepositoryInterface;


class ShowHrUseCase
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

    public function execute(int $id)
    {
        return $this->repository->show($id);
    }
}
