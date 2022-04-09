<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\ProductIngredient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Ingredient::create([
            'name' => 'beef',
            'incoming_quantity' => 20,
            'unit' => 'kg'
        ]);
        \App\Models\Ingredient::create([
            'name' => 'cheese',
            'incoming_quantity' => 5,
            'unit' => 'kg'
        ]);
        \App\Models\Ingredient::create([
            'name' => 'onion',
            'incoming_quantity' => 1,
            'unit' => 'kg'
        ]);
        $products = \App\Models\Product::factory(10)->create();

        if (is_iterable($products)) {
            foreach ($products as $index => $product) {
                ProductIngredient::create([
                    'product_id' => $product->id,
                    'ingredient_id' => Ingredient::where('name', 'cheese')->first()->id,
                    'quantity' => rand(20, 30)/1000
                ]);
                ProductIngredient::create([
                    'product_id' => $product->id,
                    'ingredient_id' => Ingredient::where('name', 'onion')->first()->id,
                    'quantity' => rand(20, 30)/1000

                ]);
                ProductIngredient::create([
                    'product_id' => $product->id,
                    'ingredient_id' => Ingredient::where('name', 'beef')->first()->id,
                    'quantity' => rand(150, 300)/1000

                ]);
            }
        }
    }
}
