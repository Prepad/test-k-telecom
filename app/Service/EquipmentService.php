<?php
namespace App\Service;

use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Builder;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Request;

class EquipmentService
{
    public static function getSeacheableFields(Request $request): array
    {
        $existingFields = [];
        foreach (Equipment::$searcheable as $field) {
            if ($request->query->has($field)) {
                $existingFields[] = $field;
            }
        }
        return $existingFields;
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

    public static function createEquipmentFromRequest(array $data, array $errors): array
    {
        $resultArray = [];
        $invalidIdsArray = [];
        foreach ($errors as $key => $error) {
            $key = preg_replace('/[^0-9]/', '', $key);
            $resultArray['errors'][] = [
                'key' => $key,
                'error' => implode(', ', $error),
            ];
            $invalidIdsArray[] = $key;
        }
        foreach ($data as $key => $item) {
            $key = preg_replace('/[^0-9]/', '', $key);
            if (in_array($key, $invalidIdsArray)) {
                continue;
            }
            $equipment = new Equipment();
            $equipment->fill($item);
            try {
                $equipment->save();
                $resultArray['success'][] = [
                    'key' => $key,
                    'resource' => EquipmentResource::make($equipment),
                ];
            } catch (Exception $e) {
                $resultArray['errors'][] = [
                    'key' => $key,
                    'error' => $e->getMessage(),
                ];
            } catch (\Throwable $e) {
                $resultArray['errors'][] = [
                    'key' => $key,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return $resultArray;
    }
}
