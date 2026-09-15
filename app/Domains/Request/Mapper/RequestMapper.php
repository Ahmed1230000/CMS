<?php

namespace App\Domains\Request\Mapper;

use App\Domains\Request\Entities\Request\RequestEntity;
use App\Models\Request;

class RequestMapper
{
    public static function toEntity(Request $request): RequestEntity
    {
        return  RequestEntity::reconstitute([
            'id'           => $request->id,
            'requester_id' => $request->requester_id,
            'type'         => $request->type,
            'status'       => $request->status,
            'reason'       => $request->reason,
            'approved_by'  => $request->approved_by,
            'approved_at'  => $request->approved_at,
            'rejected_by'  => $request->rejected_by,
            'rejected_at'  => $request->rejected_at,
            'created_at'   => $request->created_at,
            'updated_at'   => $request->updated_at,
        ]);
    }
}
