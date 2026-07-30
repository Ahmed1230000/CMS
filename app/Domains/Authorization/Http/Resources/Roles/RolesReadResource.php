<?php

namespace App\Domains\Authorization\Http\Resources\Roles;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class RolesReadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            // TODO: map model fields
            'id' => $this->id,
            'name' => $this->name,
            'guard_name' => $this->guard_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
