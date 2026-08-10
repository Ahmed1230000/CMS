<?php

namespace App\Domains\Identity\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;

use App\Domains\Identity\UseCases\RegisterUseCase\RegisterUseCase;
use App\Domains\Identity\Http\Requests\Register\StoreRegisterFormRequest;
use App\Domains\Identity\DTOs\Register\RegisterDTO;
use App\Domains\Identity\Http\Resources\Register\RegisterResource;

class RegisterController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */


    public function __construct(
        private RegisterUseCase $useCase
    ) {}


    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke(
        StoreRegisterFormRequest $request
    ) {
        try {

            $requestData = $request->validated();

            $dto = RegisterDTO::from($requestData);

            $usecaseData = $this->useCase->execute($dto);

            $data = RegisterResource::make($usecaseData);

            return $this->apiResponse(
                $data,
                'Register created successfully',
                201
            );
        } catch (\Throwable $e) {

            $this->logMessage($e);

            return $this->apiResponse(
                $e->getMessage(),
                500
            );
        }
    }
}
