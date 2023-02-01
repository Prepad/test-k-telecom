<?php

namespace App\Http\Resources;

use App\Models\EquipmentType;
use Illuminate\Http\Resources\Json\JsonResource;

class EquipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $equipmentType = EquipmentType::query()->where('id', '=', $this->equipment_type_id)->first();
        return [
            'id' => $this->id,
            'equipment_type' => [
                'id' => $equipmentType->id,
                'name' => $equipmentType->name,
                'mask' => $equipmentType->serial_number_mask,
            ],
            'note' => $this->note,
            'serial_key' => $this->serial_key,
            'created_at' => date_format($this->created_at, 'd.m.Y H:i:s'),
            'updated_at' => date_format($this->updated_at, 'd.m.Y H:i:s'),
        ];
    }
}
