<?php

namespace App\Domains\Authorization\Http\Resources\Permission;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domains\Authorization\Entities\Permission\PermissionEntity;
use Illuminate\Http\Request;

class PermissionResource extends JsonResource
{
    /** @var PermissionEntity */
    public $resource;

    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->resource->id,
            'name'       => $this->resource->name,
            'guard_name' => $this->resource->guard_name,
            'created_at' => $this->resource->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->resource->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
