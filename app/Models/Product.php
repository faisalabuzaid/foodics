<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public function productIngredients(): HasMany
    {
        return $this->hasMany(ProductIngredient::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }


    public function totalIngredientsQuantity(): float
    {
        if ($this->ingredients) {
            $total_quantity =0;
            foreach ($this->ingredients as $ingredient) {
                $total_quantity+= $ingredient->quantity;
            }
            return $total_quantity;
        }
        return 0;
    }
}
