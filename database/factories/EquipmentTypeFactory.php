<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentType>
 */
class EquipmentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word(),
            'serial_number_mask' => fake()->regexify("(N|A|a|X|Z){10}"),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

}
