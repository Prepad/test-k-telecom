<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\EquipmentType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Equipment>
 */
class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $equipmentType = EquipmentType::query()->inRandomOrder()->first();
        return [
            'equipment_type_id' => $equipmentType->id,
            'serial_key' => $this->generateSerialKeyFromMask($equipmentType->serial_number_mask),
            'note' => fake()->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }


    /**
     * @param string $mask
     * @return string
     */
    public function generateSerialKeyFromMask(string $mask): string
    {
        $chars = str_split($mask);
        $serialKey = '';
        foreach ($chars as $char) {
            switch ($char) {
                case 'N':
                    $serialKey .= fake()->numberBetween(0,9);
                    break;
                case 'A':
                    $serialKey .= strtoupper(fake()->randomLetter());
                    break;
                case 'a':
                    $serialKey .= strtolower(fake()->randomLetter());
                    break;
                case 'X':
                    if(rand(0,1) == 0) {
                        $serialKey .= fake()->numberBetween(0,9);
                    } else {
                        $serialKey .= strtoupper(fake()->randomLetter());
                    }
                    break;
                case 'Z':
                    $symbolArray = ['-', '_', '@'];
                    $serialKey .= $symbolArray[array_rand($symbolArray)];
                    break;
            }
        }
        return $serialKey;
    }
}
