<?php

namespace App\Domains\Payment\Services\Paymob;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    public function createPaymentIntention(
        float $amount,
        string $reference,
    ): array {
        $amountInCents = (int) round($amount * 100);

        $response = Http::baseUrl(
            config('services.paymob.base_url')
        )
            ->withToken(config('services.paymob.secret_key'))
            ->acceptJson()
            ->post('/v1/intention/', [

                'amount' => $amountInCents,

                'currency' => config('services.paymob.currency'),

                'payment_methods' => [
                    (int) config('services.paymob.card_integration_id'),
                ],

                'notification_url' => config('services.paymob.webhook_url'),
                'redirection_url' => config('services.paymob.redirection_url'),

                'items' => [
                    [
                        'name' => 'Medical Consultation',
                        'amount' => $amountInCents,
                        'description' => 'Medical consultation and healthcare services',
                        'quantity' => 1,
                    ],
                ],

                'billing_data' => [
                    'apartment' => '12',
                    'first_name' => 'Ahmed',
                    'last_name' => 'Mahmoud',
                    'street' => '90th Street',
                    'building' => '25',
                    'phone_number' => '+201100000000',
                    'city' => 'New Cairo',
                    'country' => 'EG',
                    'email' => 'ahmed.mahmoud@example.com',
                    'floor' => '3',
                    'state' => 'Cairo',
                ],

                'special_reference' => $reference,
            ]);

        $response->throw();

        return [
            'paymob_order_id'       => $response['intention_order_id'],
            'paymob_intention_id'   => $response['id'],
            'client_secret'         => $response['client_secret'],
            'paymob_transaction_id' => null,
        ];
    }
}
