<?php

namespace App\Domains\Invoice\Services\Invoice;

use App\Domains\Invoice\Enums\InvoiceStatusEnum;
use App\Domains\Invoice\Exceptions\Invoice\InvalidPaymentAmountException;
use App\Domains\Invoice\Exceptions\Invoice\PaymentAmountExceedsInvoiceTotalException;
use App\Domains\Invoice\Exceptions\Invoice\PaymentAmountExceedsRemainingException;
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
    public function calculatePaymentImpact(Invoice $invoice, float $paymentAmount): array
    {

        if ($paymentAmount <= 0) {
            throw new InvalidPaymentAmountException('Payment amount must be greater than 0.');
        }

        if ($paymentAmount > $invoice->total) {
            throw new PaymentAmountExceedsInvoiceTotalException('Payment amount cannot exceed the invoice total.');
        }

        if ($paymentAmount > (float) $invoice->remaining_amount) {
            throw new PaymentAmountExceedsRemainingException(
                'Payment amount cannot exceed the remaining invoice amount.'
            );
        }

        $newPaidAmount = (float) $invoice->paid_amount + $paymentAmount;

        $remainingAmount = (float) $invoice->total - $newPaidAmount;


        if ($remainingAmount > (float) $invoice->remaining_amount) {
            throw new PaymentAmountExceedsRemainingException('Payment amount cannot exceed the remaining invoice amount.');
        }

        $newPaidAmount = (float) $invoice->paid_amount + $paymentAmount;

        $remainingAmount = (float) $invoice->total - $newPaidAmount;

        $status = InvoiceStatusEnum::PARTIALLY_PAID;

        if ($newPaidAmount == (float) $invoice->total) {
            $status = InvoiceStatusEnum::PAID;
        }

        return [
            'paid_amount'      => $newPaidAmount,
            'remaining_amount' => $remainingAmount,
            'status'           => $status,
        ];
    }
}
