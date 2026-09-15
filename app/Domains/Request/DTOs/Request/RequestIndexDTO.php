<?php

namespace App\Domains\Request\DTOs\Request;

use App\Domains\Request\Enums\RequestStatusEnum;

class RequestIndexDTO
{
    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct(
        public readonly int $id,
        public readonly int $requester_id,
        public readonly string $requester_name,
        public readonly string $type,
        public readonly RequestStatusEnum $status,
        public readonly ?string $reason,
        public readonly ?string $approved_by_name,
        public readonly ?string $rejected_by_name,
        public readonly string $created_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            requester_id: $data['requester_id'],
            requester_name: $data['requester_name'],
            type: $data['type'],
            status: $data['status'],
            reason: $data['reason'] ?? null,
            approved_by_name: $data['approved_by_name'] ?? null,
            rejected_by_name: $data['rejected_by_name'] ?? null,
            created_at: $data['created_at'],
        );
    }
}
