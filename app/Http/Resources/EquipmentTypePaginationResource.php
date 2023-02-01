<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentTypePaginationResource extends JsonResource
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
            'data' => EquipmentTypeResourceCollection::make($this->resource->items()),
            'currentPage' => $this->resource->currentPage(),
            'lastPage' => $this->resource->lastPage(),
        ];
    }
}
