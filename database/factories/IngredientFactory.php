<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredient>
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
        $quantities_array = [0.15, 0.1, 0.2, 0.3];
        return [
            'name' => array_rand($names_array),
            'unit' =>'kg',
            'quantity' => array_rand($quantities_array),
        ];
    }
}
