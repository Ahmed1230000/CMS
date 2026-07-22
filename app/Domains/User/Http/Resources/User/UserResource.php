<?php

namespace App\Domains\User\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domains\User\DTOs\User\UserDTO;
use Illuminate\Http\Request;

class UserResource extends JsonResource
{
    /** @var UserDTO */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getId()?->value(),

            // TODO: map DTO fields
            // 'name' => $this->resource->getName()->value(),

            // 🔥 VO example
            // 'email' => $this->resource->getEmail()->value(),

            // 🔥 nullable VO
            // 'optional' => $this->resource->getSomething()?->value(),

            'created_at' => $this->resource->getCreatedAt(),
            'updated_at' => $this->resource->getUpdatedAt(),
        ];
    }
}