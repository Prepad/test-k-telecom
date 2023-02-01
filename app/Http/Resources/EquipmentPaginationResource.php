<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property LengthAwarePaginator $resource
 */
class EquipmentPaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => EquipmentResourceCollection::make($this->resource->items()),
            'currentPage' => $this->resource->currentPage(),
            'lastPage' => $this->resource->lastPage(),
        ];
    }
}
