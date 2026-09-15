<?php

namespace App\Domains\Request\Entities\Request;

use App\Domains\Request\Enums\RequestStatusEnum;
use Carbon\Carbon;

class RequestEntity
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $requester_id,
        public readonly string $type,
        public readonly RequestStatusEnum $status,
        public readonly ?string $reason,
        public readonly ?int $approved_by,
        public readonly ?Carbon $approved_at,
        public readonly ?int $rejected_by,
        public readonly ?Carbon $rejected_at,
        public readonly Carbon $created_at,
        public readonly Carbon $updated_at,
    ) {}

    public static function create(array $data): self
    {
        return new self(
            id: null,
            requester_id: auth()->id(),
            type: $data['type'],
            status: RequestStatusEnum::PENDING,
            reason: $data['reason'] ?? null,
            approved_by: null,
            approved_at: null,
            rejected_by: null,
            rejected_at: null,
            created_at: now(),
            updated_at: now(),
        );
    }
    public function update(array $data): self
    {
        $now = new Carbon();
        return new self(
            id: $this->id,
            requester_id: $this->requester_id,
            type: $data['type'] ?? $this->type,
            status: $this->status,
            reason: $data['reason'] ?? $this->reason,
            approved_by: $this->approved_by,
            approved_at: $this->approved_at,
            rejected_by: $this->rejected_by,
            rejected_at: $this->rejected_at,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }

    public static function reconstitute(array $data): self
    {
        return new self(
            id: $data['id'],
            requester_id: $data['requester_id'],
            type: $data['type'],
            status: $data['status'],
            reason: $data['reason'] ?? null,
            approved_by: $data['approved_by'] ?? null,
            approved_at: $data['approved_at'] ?? null,
            rejected_by: $data['rejected_by'] ?? null,
            rejected_at: $data['rejected_at'] ?? null,
            created_at: $data['created_at'],
            updated_at: $data['updated_at'],
        );
    }

    public function approve(int $approvedBy): self
    {
        return new self(
            id: $this->id,
            requester_id: $this->requester_id,
            type: $this->type,
            status: RequestStatusEnum::APPROVED,
            reason: $this->reason,
            approved_by: $approvedBy,
            approved_at: now(),
            rejected_by: null,
            rejected_at: null,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }

    public function reject(int $rejectedBy): self
    {
        return new self(
            id: $this->id,
            requester_id: $this->requester_id,
            type: $this->type,
            status: RequestStatusEnum::REJECTED,
            reason: $this->reason,
            approved_by: null,
            approved_at: null,
            rejected_by: $rejectedBy,
            rejected_at: now(),
            created_at: $this->created_at,
            updated_at: now(),
        );
    }

    public function cancel(): self
    {
        return new self(
            id: $this->id,
            requester_id: $this->requester_id,
            type: $this->type,
            status: RequestStatusEnum::CANCELLED,
            reason: $this->reason,
            approved_by: $this->approved_by,
            approved_at: $this->approved_at,
            rejected_by: $this->rejected_by,
            rejected_at: $this->rejected_at,
            created_at: $this->created_at,
            updated_at: now(),
        );
    }
}
