<?php

namespace App\Domains\Invoice\Repositories\Contracts\InvoiceItem;

use App\Domains\Invoice\Entities\InvoiceItem\InvoiceItemEntity;

interface InvoiceItemRepositoryInterface
{
    /**
     * Implement Your Entity And Enjoy Develop
     * Define your contract.
     * The implementation depends on your business rules.
     */

    public function index(int $id);
    public function show(int $id);
    public function create(InvoiceItemEntity $invoiceItemEntity): InvoiceItemEntity;
    public function update(InvoiceItemEntity $invoiceItemEntity): InvoiceItemEntity;
    public function find(int $id): InvoiceItemEntity;
    public function delete(int $id);
}
