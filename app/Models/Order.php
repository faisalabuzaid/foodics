<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    
    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * Get Unique Order Ingredient IDs
     *
     * @return array
     */
    public function getOrderIngredientIds(): array
    {
        $ingredients = [];
        foreach ($this->orderProducts as $order_product) {
            $ingredients[] = $order_product->getOrderProductIngredients();
        }

        return $this->formatOrderIngredientsArray($ingredients);
    }

    /**
     * Merge array of arrays and get array with unique values
     *
     * @param array $ingredients
     * @return array
     */
    private function formatOrderIngredientsArray(array $ingredients): array
    {
        $ingredients = call_user_func_array('array_merge', $ingredients);
        $ingredients = array_unique($ingredients);

        return $ingredients;
    }
}
