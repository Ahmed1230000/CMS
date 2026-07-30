<?php

namespace App\Domains\Authorization\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;

use App\Domains\Authorization\UseCases\SyncRolePermissionsUseCase\SyncRolePermissionsUseCase;
use App\Domains\Authorization\DTOs\Roles\SyncRolePermissionsDTO;
use App\Domains\Authorization\Http\Requests\Roles\StoreSyncRolePermissionsFormRequest;
use App\Domains\Authorization\Http\Resources\Roles\RolesResource;

class SyncRolePermissionsController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */


    public function __construct(
        private SyncRolePermissionsUseCase $useCase
    ) {}


    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke(StoreSyncRolePermissionsFormRequest $request)
    {
        try {
            $requestData = $request->validated();
            $dto = SyncRolePermissionsDTO::fromArray($requestData);
            $this->useCase->execute($dto);
            return $this->apiResponse(
                null,
                'Permissions synced successfully.',
                201
            );
        } catch (\Throwable $e) {

            $this->logMessage($e);

            return $this->apiResponse(
                null,
                $e->getMessage(),
                500
            );
        }
    }
}
