<?php

namespace App\Domains\Authorization\Http\Resources\Permission;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class PermissionReadResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'guard_name' => $this->guard_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
