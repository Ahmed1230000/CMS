<?php

namespace App\Domains\Request\Repositories\Eloquent\Request;

use App\Domains\Request\DTOs\Request\RequestIndexDTO;
use App\Domains\Request\DTOs\Request\RequestShowDTO;
use App\Domains\Request\Entities\Request\RequestEntity;
use App\Domains\Request\Mapper\RequestMapper;
use App\Domains\Request\Repositories\Contracts\Request\RequestRepositoryInterface;
use App\Infrastructure\QueryBuilder\Request\RequestQueryBuilder;
use App\Models\Request;

class RequestEloquentRepository implements RequestRepositoryInterface
{
    public function index()
    {
        return (new RequestQueryBuilder())->queryIndex()->paginate(10)->through(function ($request) {
            return RequestIndexDTO::fromArray([
                'id'               => $request->id,
                'requester_id'     => $request->requester_id,
                'requester_name'   => $request->requester?->name,
                'type'             => $request->type,
                'status'           => $request->status,
                'reason'           => $request->reason,
                'approved_by_name' => $request->approvedBy?->name,
                'rejected_by_name' => $request->rejectedBy?->name,
                'created_at'       => $request->created_at,
                'updated_at'       => $request->updated_at,
            ]);
        });
    }

    public function show(int $id)
    {
        $request = (new RequestQueryBuilder())->queryShow($id);

        return RequestShowDTO::fromArray([
            'id'               => $request->id,
            'requester_id'     => $request->requester_id,
            'requester_name'   => $request->requester?->name,
            'type'             => $request->type,
            'status'           => $request->status,
            'reason'           => $request->reason,
            'approved_by'      => $request->approved_by,
            'approved_by_name' => $request->approvedBy?->name,
            'approved_at'      => $request->approved_at,
            'rejected_by'      => $request->rejected_by,
            'rejected_by_name' => $request->rejectedBy?->name,
            'rejected_at'      => $request->rejected_at,
            'created_at'       => $request->created_at,
            'updated_at'       => $request->updated_at,
        ]);
    }

    public function create(RequestEntity $requestEntity): RequestEntity
    {
        $request = Request::create([
            'requester_id' => $requestEntity->requester_id,
            'type'         => $requestEntity->type,
            'reason'       => $requestEntity->reason,
            'status'       => $requestEntity->status,
            // 'approved_by'  => $requestEntity->approved_by,
            // 'approved_at'  => $requestEntity->approved_at,
            // 'rejected_by'  => $requestEntity->rejected_by,
            // 'rejected_at'  => $requestEntity->rejected_at,
        ]);

        return RequestMapper::toEntity($request);
    }
    public function update(RequestEntity $requestEntity): RequestEntity
    {
        $request = Request::findOrFail($requestEntity->id);

        $request->update([
            'requester_id' => $requestEntity->requester_id,
            'type'         => $requestEntity->type,
            'reason'       => $requestEntity->reason,
            // 'status'       => $requestEntity->status,
            // 'approved_by'  => $requestEntity->approved_by,
            // 'approved_at'  => $requestEntity->approved_at,
            // 'rejected_by'  => $requestEntity->rejected_by,
            // 'rejected_at'  => $requestEntity->rejected_at,
        ]);
        return RequestMapper::toEntity($request);
    }

    public function find(int $id): RequestEntity
    {
        $request = Request::findOrFail(($id));
        return RequestMapper::toEntity($request);
    }
}
