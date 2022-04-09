<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $names_array = ['beef', 'cheese', 'onion'];
        $quantities_array = [20, 5, 1];
        return [
            'name' => $names_array[array_rand($names_array)],
            'unit' =>'kg',
            'incoming_quantity' => $quantities_array[array_rand($quantities_array)],
        ];
    }
}
