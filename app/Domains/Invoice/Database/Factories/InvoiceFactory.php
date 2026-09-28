<?php

namespace App\Domains\Invoice\Database\Factories;

use App\Domains\Invoice\Enums\InvoiceStatusEnum;
use App\Domains\Invoice\Enums\InvoiceTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'invoice_number' => fake()->unique()->numerify('INV-#####'),
            'type' => InvoiceTypeEnum::DIRECT,
            'status' => InvoiceStatusEnum::UNPAID,
            'subtotal' => 1000,
            'discount' => 0,
            'tax' => 0,
            'total' => 1000,
            'paid_amount' => 0,
            'remaining_amount' => 1000,
        ];
    }
}
