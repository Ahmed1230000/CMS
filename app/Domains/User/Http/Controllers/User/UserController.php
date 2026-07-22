<?php

namespace App\Domains\User\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;

use App\Models\User;

use App\Domains\User\Http\Requests\User\{
    StoreUserFormRequest,
    UpdateUserFormRequest
};

use App\Domains\User\DTOs\User\UserDTO;
use App\Domains\User\UseCases\User\CreateUserUseCase;
use App\Domains\User\UseCases\User\UpdateUserUseCase;
use App\Domains\User\UseCases\User\DeleteUserUseCase;

use App\Domains\User\Http\Resources\User\{
    UserResource,
    UserReadResource
};

use App\Infrastructure\QueryBuilder\User\UserQueryBuilder;

class UserController extends Controller
{
    use ApiResponse, LogMessage;

    public function __construct(
        private CreateUserUseCase $createUseCase,
        private UpdateUserUseCase $updateUseCase,
        private DeleteUserUseCase $deleteUseCase,
        private UserQueryBuilder $queryBuilder
    ) {
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        try {
            $data = $this->queryBuilder->query()->paginate();

return UserReadResource::collection($data);
        } catch (\Throwable $e) {
            $this->logMessage('Fetch User Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }

    public function show($id)
    {
        try {
            $item = $this->queryBuilder->query()->findOrFail($id);

return $this->apiResponse(UserReadResource::make($item), 'User retrieved successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Fetch User Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }

    public function store(StoreUserFormRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $dto = UserDTO::fromArray($data);

            $result = $this->createUseCase->execute($dto);

            return $this->apiResponse(new UserResource($result), 'User created successfully', 201);
        } catch (\Throwable $e) {
            $this->logMessage('Create User Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }

    public function update(UpdateUserFormRequest $request, $id): JsonResponse
    {
        try {
            $data = $request->validated();

            $dto = UserDTO::fromArray([
                ...$data,
            ]);

            $result = $this->updateUseCase->execute($dto);

            return $this->apiResponse(new UserResource($result), 'User updated successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Update User Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->deleteUseCase->execute($id);

            return $this->apiResponse(null, 'User deleted successfully', 200);
        } catch (\Throwable $e) {
            $this->logMessage('Delete User Failed', [
                'error' => $e->getMessage()
            ], 'error');

            return $this->apiResponse(null, 'Something went wrong', 500);
        }
    }
}