<?php

namespace App\Domains\Payment\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Common\Traits\ApiResponse;
use App\Common\Traits\LogMessage;
use App\Domains\Payment\Repositories\Contracts\Payment\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymobPaymentResultController extends Controller
{
    use ApiResponse, LogMessage;

    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */
    public function __construct(private PaymentRepositoryInterface $paymentRepositoryInterface) {}



    /*
    |--------------------------------------------------------------------------
    | Invoke
    |--------------------------------------------------------------------------
    */

    public function __invoke(Request $request)
    {
        try {
            $payment =  $this->paymentRepositoryInterface->where(
                'paymob_order_id',
                $request->query('order')
            );

            if (! $payment) {
                return redirect()->route('invoices.index');
            }

            return redirect()->route('invoices.show', [
                'id' => $payment->invoice_id,
            ]);
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
