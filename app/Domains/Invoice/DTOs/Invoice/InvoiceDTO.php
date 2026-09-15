<?php

namespace App\Domains\Invoice\DTOs\Invoice;

use App\Domains\Invoice\Enums\InvoiceTypeEnum;

class InvoiceDTO
{
    public function __construct(
        public readonly ?int $patientId = null,
        public readonly ?int $prescriptionId = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            patientId: $data['patient_id'] ?? null,
            prescriptionId: $data['prescription_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'patient_id' => $this->patientId,
            'prescription_id' => $this->prescriptionId,
        ];
    }
}
