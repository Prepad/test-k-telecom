<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EquipmentResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $response = parent::toArray($request);
        foreach ($response as &$item) {
            $item = [
                'id' => $item['id'],
                'equipment_type_id' => $item['equipment_type']['id'],
                'serial_key' => $item['serial_key'],
                'note' => $item['note'],
            ];
        }
        return $response;
    }
}
