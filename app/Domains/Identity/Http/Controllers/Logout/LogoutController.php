<?php

namespace App\Domains\Identity\Http\Controllers\Logout;

use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;

use App\Domains\Identity\UseCases\LogoutUseCase\LogoutUseCase;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */


    public function __construct(
        private LogoutUseCase $useCase
    ) {}


    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke()
    {
        try {
            $usecaseData = $this->useCase->execute(auth()->user()->id);
            return $this->apiResponse(
                $usecaseData,
                'Logged out successfully.',
                200
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
