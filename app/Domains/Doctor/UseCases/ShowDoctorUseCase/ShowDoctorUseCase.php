<?php

namespace App\Domains\Doctor\UseCases\ShowDoctorUseCase;

use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;


class ShowDoctorUseCase
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private DoctorRepositoryInterface $repository
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
