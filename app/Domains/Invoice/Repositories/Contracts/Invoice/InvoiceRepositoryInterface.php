<?php

namespace App\Domains\Invoice\Repositories\Contracts\Invoice;

use App\Domains\Invoice\Entities\Invoice\InvoiceEntity;

interface InvoiceRepositoryInterface
{
     /**
      * Implement Your Entity And Enjoy Develop
      * Define your contract.
      * The implementation depends on your business rules.
      */

     public function index();
     public function show(int $id);
     public function create(InvoiceEntity $invoiceEntity): InvoiceEntity;
     public function insertInvoiceNumber(InvoiceEntity $invoiceEntity): InvoiceEntity;
     public function updateTotals(int $id, array $totals);
     public function find(int $id);
     public function hasItems(int $invoiceId);
     public function findByEntity(int $id): InvoiceEntity;
     public function changeToUnpaid(InvoiceEntity $invoiceEntity);
     public function updatePaymentState(int $id, array $updatePayment);
}
