<?php

namespace App\Domains\Request\Repositories\Contracts\Request;

use App\Domains\Request\Entities\Request\RequestEntity;

interface RequestRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index();
    public function show(int $id);
    public function create(RequestEntity $requestEntity): RequestEntity;
    public function update(RequestEntity $requestEntity): RequestEntity;
    public function find(int $id): RequestEntity;
}
