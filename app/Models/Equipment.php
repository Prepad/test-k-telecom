<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpFoundation\Request;

/**
 * @property int id
 * @property int equipment_type_id
 * @property string serial_key
 * @property string note
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'equipment';

    protected $fillable = [
        'equipment_type_id',
        'serial_key',
        'note',
    ];

    protected $casts = [
        'created_at' => 'date:d.m.Y H:i:s',
        'updated_at' => 'date:d.m.Y H:i:s',
        'deleted_at' => 'date:d.m.Y H:i:s',
    ];

    protected $visible = [
        'id',
        'equipment_type_id',
        'serial_key',
        'note',
        'created_at',
        'updated_at',
    ];

    protected $perPage = 5;

    public static $searcheable = [
        'equipment_type_id',
        'serial_key',
        'note',
    ];

    public static function checkSearchFields(Request $request): array
    {
        $existingFields = [];
        foreach (self::$searcheable as $field) {
            if ($request->query->has($field)) {
                $existingFields[] = $field;
            }
        }
        return $existingFields;
    }
}
