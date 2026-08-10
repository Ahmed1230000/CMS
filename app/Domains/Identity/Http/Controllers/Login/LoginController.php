<?php

namespace App\Domains\Identity\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;

use App\Domains\Identity\UseCases\LoginUseCase\LoginUseCase;
use App\Domains\Identity\Http\Requests\Login\StoreLoginFormRequest;
use App\Domains\Identity\DTOs\Login\LoginDTO;
use App\Domains\Identity\Http\Resources\Login\LoginResource;

class LoginController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */


    public function __construct(
        private LoginUseCase $useCase
    ) {}


    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke(
        StoreLoginFormRequest $request
    ) {
        try {

            $requestData = $request->validated();

            $dto = LoginDTO::from($requestData);

            $usecaseData = $this->useCase->execute($dto);

            $data = LoginResource::make($usecaseData);

            return $this->apiResponse(
                $data,
                'Login in successfully',
                200
            );
        } catch (\Throwable $e) {

            $this->logMessage($e);

            return $this->apiResponse(
                null,
                $e->getMessage(),
                401
            );
        }
    }
}
