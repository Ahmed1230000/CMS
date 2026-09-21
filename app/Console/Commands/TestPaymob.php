<?php

namespace App\Console\Commands;

use App\Domains\Payment\Services\Paymob\PaymobService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('paymob:test')]
#[Description('Command description')]
class TestPaymob extends Command
{
    protected $signature = 'paymob:test';

    protected $description = 'Test Paymob payment intention';

    public function handle(PaymobService $paymobService): int
    {
        $response = $paymobService->createPaymentIntention(
            amount: 100,
            reference: 'IN-TEST-008',
        );

        $this->line(
            json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );

        return self::SUCCESS;
    }
}
