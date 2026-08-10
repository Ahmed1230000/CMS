<?php

namespace App\Domains\Authorization\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;
use App\Models\Permission;

use App\Domains\Authorization\Http\Requests\Permission\{
    StorePermissionFormRequest,
    UpdatePermissionFormRequest
};

use App\Domains\Authorization\DTOs\Permission\PermissionDTO;
use App\Domains\Authorization\UseCases\Permission\CreatePermissionUseCase;
use App\Domains\Authorization\UseCases\Permission\UpdatePermissionUseCase;
use App\Domains\Authorization\UseCases\Permission\DeletePermissionUseCase;

use App\Domains\Authorization\Http\Resources\Permission\{
    PermissionResource,
    PermissionReadResource
};

use App\Infrastructure\QueryBuilder\Permission\PermissionQueryBuilder;

class PermissionController extends Controller
{
    use ApiResponse, LogMessage;

    public function __construct(
        private CreatePermissionUseCase $createUseCase,
        private UpdatePermissionUseCase $updateUseCase,
        private DeletePermissionUseCase $deleteUseCase,
        private PermissionQueryBuilder $queryBuilder
    ) {
        $this->authorizeResource(Permission::class, 'permission');
    }

    public function index()
    {
        try {
            $data = $this->queryBuilder->query()->paginate();

            return PermissionReadResource::collection($data);
        } catch (\Throwable $e) {
            $this->logMessage('Fetch Permission Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }

    public function show(Permission $permission)
    {
        try {
            $item = $this->queryBuilder->query()->findOrFail($permission->id);

            return $this->apiResponse(PermissionReadResource::make($item), 'Permission retrieved successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Fetch Permission Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }

    public function store(StorePermissionFormRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $dto = PermissionDTO::fromArray($data);

            $result = $this->createUseCase->execute($dto);

            return $this->apiResponse(new PermissionResource($result), 'Permission created successfully', 201);
        } catch (\Throwable $e) {
            $this->logMessage('Create Permission Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }

    public function update(UpdatePermissionFormRequest $request, Permission $permission): JsonResponse
    {
        try {
            $data = $request->validated();

            $dto = PermissionDTO::fromArray([
                ...$data,
            ]);

            $result = $this->updateUseCase->execute($permission->id, $dto);

            return $this->apiResponse(new PermissionResource($result), 'Permission updated successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Update Permission Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }

    public function destroy(Permission $permission)
    {
        try {
            $this->deleteUseCase->execute($permission->id);

            return $this->apiResponse(null, 'Permission deleted successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Delete Permission Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }
}
