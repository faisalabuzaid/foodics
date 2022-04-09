<?php

namespace App\Listeners;

use App\Events\IngredientStockLevelReachesHalf;
use App\Events\OrderCreated;
use App\Models\Ingredient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckOrderIngredientsStockLevel
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        foreach ($event->order->getOrderIngredientIds() as $ingredient_id) {
            /** @var Ingredient $ingredient */
            $ingredient = Ingredient::find($ingredient_id);
            ray($ingredient->reachesHalfIncomingQuantity());
            if (! $ingredient->reachesHalfIncomingQuantity()) {
                continue;
            }
            ray($ingredient->merchantHasRecentlyNotified());
            if (!$ingredient->merchantHasRecentlyNotified()) {
                event(new IngredientStockLevelReachesHalf($ingredient));
                $ingredient->recordNotification();
            }
        }
    }
}
