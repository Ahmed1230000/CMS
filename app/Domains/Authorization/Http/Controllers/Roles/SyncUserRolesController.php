<?php

namespace App\Domains\Authorization\Http\Controllers\Roles;

use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;

use App\Domains\Authorization\UseCases\SyncUserRolesUseCase\SyncUserRolesUseCase;
use App\Domains\Authorization\Http\Requests\Roles\StoreSyncUserRolesFormRequest;
use App\Domains\Authorization\DTOs\Roles\SyncUserRolesDTO;

class SyncUserRolesController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */


    public function __construct(
        private SyncUserRolesUseCase $useCase
    ) {}


    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke(StoreSyncUserRolesFormRequest $request)
    {
        try {

            $requestData = $request->validated();

            $dto = SyncUserRolesDTO::fromArray($requestData);

            $usecaseData = $this->useCase->execute($dto);

            return $this->apiResponse(
                null,
                'Roles created successfully',
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
