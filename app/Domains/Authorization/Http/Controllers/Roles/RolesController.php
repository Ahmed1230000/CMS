<?php

namespace App\Domains\Authorization\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;

use App\Models\Roles;

use App\Domains\Authorization\Http\Requests\Roles\{
    StoreRolesFormRequest,
    UpdateRolesFormRequest
};

use App\Domains\Authorization\DTOs\Roles\RolesDTO;
use App\Domains\Authorization\DTOs\Roles\UpdateRolesDTO;
use App\Domains\Authorization\UseCases\Roles\CreateRolesUseCase;
use App\Domains\Authorization\UseCases\Roles\UpdateRolesUseCase;
use App\Domains\Authorization\UseCases\Roles\DeleteRolesUseCase;

use App\Domains\Authorization\Http\Resources\Roles\{
    RolesResource,
    RolesReadResource
};

use App\Infrastructure\QueryBuilder\Roles\RolesQueryBuilder;

class RolesController extends Controller
{
    use ApiResponse, LogMessage;

    public function __construct(
        private CreateRolesUseCase $createUseCase,
        private UpdateRolesUseCase $updateUseCase,
        private DeleteRolesUseCase $deleteUseCase,
        private RolesQueryBuilder $queryBuilder
    ) {
        $this->authorizeResource(Roles::class, 'role');
    }

    public function index()
    {
        try {
            $data = $this->queryBuilder->query()->paginate();
            return RolesReadResource::collection($data);
        } catch (\Throwable $e) {
            $this->logMessage('Fetch Roles Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong ' . $e->getMessage(), 500);
        }
    }

    public function show(Roles $role)
    {
        try {
            $item = $this->queryBuilder->query()->findOrFail($role->id);

            return $this->apiResponse(RolesReadResource::make($item), 'Roles retrieved successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Fetch Roles Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong ' . $e->getMessage(), 500);
        }
    }

    public function store(StoreRolesFormRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();


            $dto = RolesDTO::fromArray($data);

            $result = $this->createUseCase->execute($dto);

            return $this->apiResponse(new RolesResource($result), 'Roles created successfully', 201);
        } catch (\Throwable $e) {
            $this->logMessage('Create Roles Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong ' . $e->getMessage(), 500);
        }
    }

    public function update(UpdateRolesFormRequest $request, Roles $role): JsonResponse
    {
        try {
            $data = $request->validated();

            $dto = UpdateRolesDTO::fromArray([
                ...$data,
            ]);

            $result = $this->updateUseCase->execute($role->id, $dto);

            return $this->apiResponse(new RolesResource($result), 'Roles updated successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Update Roles Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong ' . $e->getMessage(), 500);
        }
    }

    public function destroy(Roles $role)
    {
        try {
            $this->deleteUseCase->execute($role->id);

            return $this->apiResponse(null, 'Roles deleted successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Delete Roles Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong ' . $e->getMessage(), 500);
        }
    }
}
