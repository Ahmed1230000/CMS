<?php

namespace App\Infrastructure\QueryBuilder\MedicineItem;

use App\Domains\PHarmacy\Enums\MedicineStatusEnum;
use App\Infrastructure\BaseQueryBuilder;
use App\Models\MedicineItem;
use Spatie\QueryBuilder\QueryBuilder;

class MedicineItemQueryBuilder extends BaseQueryBuilder
{
    protected string $model = MedicineItem::class;

    protected array $allowedIncludes = [
        'medicine',
        'createdBy',
    ];

    protected array $allowedFilters = [
        'medicine_id',
        'status',
    ];

    protected array $allowedSorts = [
        'id',
        'name',
        'code',
        'created_at',
        'updated_at',
    ];

    public function queryIndex(int $id): QueryBuilder
    {
        return $this->query()
            ->select([
                'id',
                'medicine_id',
                'code',
                'name',
                'strength',
                'dosage_form',
                'unit',
                'barcode',
                'status',
                'selling_price',
                'created_by',
                'created_at',
            ])
            ->with([
                'medicine:id,name',
            ])->where('medicine_id', $id);
    }

    public function queryShow(int $id)
    {
        return $this->query()
            ->where('id', $id)
            ->with([
                'medicine:id,code,name,generic_name,manufacturer,status',
                'createdBy:id,name',
            ])
            ->firstOrFail();
    }

    public function search(string $search)
    {
        return $this->query()->select([
            'id',
            'medicine_id',
            'name',
            'code',
            'barcode',
            'strength',
            'dosage_form',
            'selling_price',
        ])->with(['medicine:id,name'])->where(function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%")
                ->orWhere('barcode', 'like', "%{$search}%");
        })->where('status', MedicineStatusEnum::ACTIVE)->limit(20)->get();
    }
}
