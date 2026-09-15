<?php

namespace App\Domains\Invoice\Services\Invoice;

use App\Models\Invoice;

class InvoiceService
{
    public function calculate(Invoice $invoice)
    {
        $discountRate = config('billing.discount_rate', 0);
        $taxRate = config('billing.tax_rate', 0);

        $subTotal = $invoice->items()->sum('total');

        $discount = $subTotal * ($discountRate / 100);

        $taxable = $subTotal - $discount;

        $tax = $taxable * ($taxRate / 100);

        $total = $taxable + $tax;

        // $finalTotal = $total * $quantity

        $remaining = $total - (float) $invoice->paid_amount;

        return [
            'subtotal' => $subTotal,
            'discount' => $discount,
            'tax' => $tax,
            'total' => $total,
            'remaining_amount' => $remaining,
        ];
    }
}
