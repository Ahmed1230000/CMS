<?php

namespace App\Domains\Identity\Http\Resources\Register;

use App\Domains\User\Entities\User\UserEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /** @var UserEntity */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'name'       => $this->resource->name,
            'email'      => $this->resource->email->value(),
            'created_at' => $this->resource->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->resource->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
