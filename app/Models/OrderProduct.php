<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProduct extends Pivot
{
    use HasFactory;

    protected $table = 'order_products';

    public $timestamps = true;

    public $incrementing = true;

    protected $guarded = [];

    protected $with = ['product'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function increaseIngredientsOutcomingQuantity(): void
    {
        if ($this->product) {
            foreach ($this->product->productIngredients as $product_ingredient) {

                /** @var Ingredient $ingredient */
                $ingredient =$product_ingredient->ingredient;
                $ingredient->outcoming_quantity = $product_ingredient->quantity * $this->quantity;
                $ingredient->save();
            }
        }
    }

    public function getOrderProductIngredients(): array
    {
        $ingredients = [];
        foreach ($this->product->productIngredients as $product_ingredient) {
            $ingredients[] = $product_ingredient->ingredient->id;
        }
        return $ingredients;
    }
}
