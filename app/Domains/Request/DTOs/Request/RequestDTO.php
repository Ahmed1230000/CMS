<?php

namespace App\Domains\Request\DTOs\Request;

class RequestDTO
{
    public function __construct(
        public readonly string $type,
        public readonly ?string $reason,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            type: $data['type'],
            reason: $data['reason'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'reason' => $this->reason,
        ];
    }
}
