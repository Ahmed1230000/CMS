<?php

namespace App\Domains\Authorization\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;

use App\Domains\Authorization\UseCases\SyncUserPermissionsUseCase\SyncUserPermissionsUseCase;
use App\Domains\Authorization\Http\Requests\Permission\StoreSyncUserPermissionsFormRequest;
use App\Domains\Authorization\DTOs\Permission\SyncUserPermissionsDTO;

class SyncUserPermissionsController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */


    public function __construct(
        private SyncUserPermissionsUseCase $useCase
    ) {}


    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke(
        StoreSyncUserPermissionsFormRequest $request
    ) {
        try {

            $requestData = $request->validated();

            $dto = SyncUserPermissionsDTO::fromArray($requestData);

            $usecaseData = $this->useCase->execute($dto);
            return $this->apiResponse(
                $usecaseData,
                'Permission created successfully',
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
