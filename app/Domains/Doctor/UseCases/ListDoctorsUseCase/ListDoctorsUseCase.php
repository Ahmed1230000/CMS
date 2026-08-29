<?php

namespace App\Domains\Doctor\UseCases\ListDoctorsUseCase;

use App\Domains\Doctor\Repositories\Contracts\Doctor\DoctorRepositoryInterface;


class ListDoctorsUseCase
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

    public function execute()
    {
        return $this->repository->index();
    }
}
