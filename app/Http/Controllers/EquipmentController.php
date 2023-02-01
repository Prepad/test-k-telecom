<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentFormRequest;
use App\Http\Resources\EquipmentPaginationResource;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\EquipmentResourceCollection;
use App\Models\Equipment;
use App\Service\EquipmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class EquipmentController extends Controller
{
    public function getEquipmentById(Equipment $equipment): EquipmentResource
    {
        return EquipmentResource::make($equipment);
    }

    public function getEquipmentPage(Request $request): EquipmentPaginationResource
    {
        $existingFields = EquipmentService::getSeacheableFields($request);
        $equipment = EquipmentService::searchByFields(Equipment::query(), $existingFields, $request)->paginate();
        return EquipmentPaginationResource::make($equipment);
    }

    public function createEquipments(EquipmentFormRequest $request)
    {
        $validator = $request->getValidator();
        $resultArray = EquipmentService::createEquipmentFromRequest($request->post('data'), $validator->errors()->toArray());
        return json_encode($resultArray);
    }

    public function deleteEquipment(Equipment $equipment)
    {
        $message = 'Requested id is not exists';
        if ($equipment->delete()) {
            $message = 'Delete equipment is successful';
        }
        return json_encode($message);
    }

    public function editEquipment(Equipment $equipment, EquipmentFormRequest $request)
    {
        $equipment->update($request->all());
    }
}
