<?php

namespace App\Listeners;

use App\Events\IngredientStockLevelReachesHalf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendNotificationToMerchant
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
     * @param  \App\Events\IngredientStockLevelReachesHalf  $event
     * @return void
     */
    public function handle(IngredientStockLevelReachesHalf $event)
    {
        ray('notification sent to merchant');
        ray($event->ingredient);
        // Mail::to($event->ingredient->merchant);
    }
}
