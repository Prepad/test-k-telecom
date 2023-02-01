<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentTypePaginationResource;
use App\Models\EquipmentType;
use App\Service\EquipmentTypeService;
use Illuminate\Http\Request;

class EquipmentTypeController extends Controller
{
    public function getEquipmentTypePage(Request $request): EquipmentTypePaginationResource
    {
        $existingFields = EquipmentTypeService::getSeacheableFields($request);
        $equipment = EquipmentTypeService::searchByFields(EquipmentType::query(), $existingFields, $request)->paginate();
        return EquipmentTypePaginationResource::make($equipment);
    }
}
