<?php

namespace App\Domains\Payment\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;
use App\Domains\Payment\DTOs\Payment\PaymobWebhookDTO;
use App\Domains\Payment\UseCases\ProcessPaymobWebhookUseCase\ProcessPaymobWebhookUseCase;
use Illuminate\Http\Request;

class PaymobWebhookController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */
    public function __construct(
        private ProcessPaymobWebhookUseCase $processPaymobWebhookUseCase,
    ) {}
    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke(Request $request)
    {
        try {
            $dto = PaymobWebhookDTO::fromArray(
                $request->all(),
                $request->query('hmac'),
            );

            $this->processPaymobWebhookUseCase->execute($dto);

            return response()->json([
                'received' => true,
            ], 200);
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
