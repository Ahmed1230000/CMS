<?php

namespace App\Domains\Hr\Repositories\Contracts\Hr;

use App\Domains\Hr\Entities\Hr\HrEntity;
use App\Models\Hr;

interface HrRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index();

    public function show(int $id);

    public function create(HrEntity $hrEntity): HrEntity;
    public function update(HrEntity $hrEntity): HrEntity;
    public function delete(int $id);
    public function find(int $id): HrEntity;
}
