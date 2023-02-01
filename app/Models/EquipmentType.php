<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string name
 * @property string serial_number_mask
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class EquipmentType extends Model
{
    use HasFactory;

    protected $table = 'equipment_types';

    protected $fillable = [
        'name',
        'serial_number_mask',
    ];

    protected $casts = [
        'created_at' => 'date:d.m.Y H:i:s',
        'updated_at' => 'date:d.m.Y H:i:s',
    ];

    protected $visible = [
        'id',
        'name',
        'serial_number_mask',
        'created_at',
        'updated_at',
    ];

    public static $searcheable = [
        'name',
        'serial_number_mask',
    ];
}
