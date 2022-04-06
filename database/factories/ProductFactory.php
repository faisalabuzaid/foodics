<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'image_url' =>$this->faker->imageUrl(),
            'price' => $this->faker->numberBetween(5, 10)
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product->ingredients()->factory(3)->create();
        });
    }
}
