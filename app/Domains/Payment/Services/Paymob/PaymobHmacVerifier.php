<?php

namespace App\Domains\Payment\Services\Paymob;

final class PaymobHmacVerifier
{
    public function verify(
        array $transaction,
        string $receivedHmac,
    ): bool {
        $values = [
            $transaction['amount_cents'],
            $transaction['created_at'],
            $transaction['currency'],
            $transaction['error_occured'],
            $transaction['has_parent_transaction'],
            $transaction['id'],
            $transaction['integration_id'],
            $transaction['is_3d_secure'],
            $transaction['is_auth'],
            $transaction['is_capture'],
            $transaction['is_refunded'],
            $transaction['is_standalone_payment'],
            $transaction['is_voided'],
            $transaction['order']['id'],
            $transaction['owner'],
            $transaction['pending'],
            $transaction['source_data']['pan'],
            $transaction['source_data']['sub_type'],
            $transaction['source_data']['type'],
            $transaction['success'],
        ];

        $payload = implode('', array_map(
            static function (mixed $value): string {
                return is_bool($value)
                    ? ($value ? 'true' : 'false')
                    : (string) $value;
            },
            $values
        ));

        $expectedHmac = hash_hmac(
            'sha512',
            $payload,
            config('services.paymob.hmac_secret'),
        );

        return hash_equals($expectedHmac, $receivedHmac);
    }
}
