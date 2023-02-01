<?php
namespace App\Service;

use App\Models\Equipment;
use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\HttpFoundation\Request;

class EquipmentTypeService
{
    public static function getMasks(array $data): array
    {
        $idsArray = [];
        if (is_array($data)) {
            $idsArray = array_map(function ($value) {
                return $value['equipment_type_id'];
            }, $data);
        }
        $equipmentTypes = EquipmentType::query()->whereIn('id', $idsArray)->get(['id', 'serial_number_mask']);
        foreach ($equipmentTypes as $item) {
            $chars = str_split($item['serial_number_mask']);
            $mask = '/';
            foreach ($chars as $char) {
                switch ($char) {
                    case 'N':
                        $mask .= "\d";
                        break;
                    case 'A':
                        $mask .= "[A-Z]";
                        break;
                    case 'a':
                        $mask .= "[a-z]";
                        break;
                    case 'X':
                        $mask .= "[A-Z\d]";
                        break;
                    case 'Z':
                        $mask .= "[-_@]";
                        break;
                }
            }
            $mask .= '/';
            $resultArray[$item['id']] = $mask;
        }
        return $resultArray;
    }

    public static function searchByFields(Builder $query, array $existingFields, Request $request): Builder
    {
        foreach ($existingFields as $field) {
            if ($request->query->has($field)) {
                $query->where($field, 'like', '%' . $request->query->get($field) . '%');
            }
        }
        return $query;
    }

    public static function getSeacheableFields(Request $request): array
    {
        $existingFields = [];
        foreach (EquipmentType::$searcheable as $field) {
            if ($request->query->has($field)) {
                $existingFields[] = $field;
            }
        }
        return $existingFields;
    }
}
