<?php

namespace Tests\Feature;

use App\Events\IngredientStockLevelReachesHalf;
use App\Events\OrderCreated;
use App\Listeners\CheckOrderIngredientsStockLevel;
use App\Listeners\SendNotificationToMerchant;
use App\Models\Ingredient;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductIngredient;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_order()
    {
        $products = Product::factory(5)->create();

        $productData = [];
        foreach ($products as $product) {
            $product->productIngredients()->save(ProductIngredient::create([
                'product_id' => $product->id,
                'ingredient_id' => Ingredient::factory()->create()->id,
                'quantity' => 0.02,
            ]));
            $productData[] = ['product'=> $product->toArray(), 'quantity' => rand(1, 5)];
        };

        $data = [
            'products' => $productData
        ];
        
        Event::fake();

        $response = $this
        ->postJson('/api/orders', $data);

        $order = Order::find($response['order']['id']);

        $response->assertCreated();
        Event::assertDispatched(
            OrderCreated::class,
            fn (OrderCreated $event) => $order->is($event->order)
        );
        Event::assertNotDispatched(IngredientStockLevelReachesHalf::class);
        Event::assertListening(OrderCreated::class, CheckOrderIngredientsStockLevel::class);
    }

    public function test_send_notification_to_merchant_when_ingredient_stock_level_reaches_half()
    {
        $product = Product::factory()->create();

        $productData = [];
        $product->productIngredients()->save(ProductIngredient::create([
                'product_id' => $product->id,
                'ingredient_id' => Ingredient::factory()->create()->id,
                'quantity' => 40,
            ]));
        $productData[] = ['product'=> $product->toArray(), 'quantity' => rand(1, 5)];

        $data = [
            'products' => $productData
        ];
        
        Event::fake();

        $response = $this
        ->postJson('/api/orders', $data);

        $order = Order::find($response['order']['id']);
        $event = new OrderCreated($order);
        $listener = new CheckOrderIngredientsStockLevel();
        $listener->handle($event);

        $response->assertCreated();
        
        Event::assertDispatched(IngredientStockLevelReachesHalf::class);
        Event::assertListening(IngredientStockLevelReachesHalf::class, SendNotificationToMerchant::class);
    }

    public function test_not_send_notification_to_merchant_when_merchant_already_get_notified()
    {
        $product = Product::factory()->create();

        $productData = [];
        $product->productIngredients()->save($product_ingredient = ProductIngredient::create([
                'product_id' => $product->id,
                'ingredient_id' => Ingredient::factory()->create()->id,
                'quantity' => 40,
            ]));
        $productData[] = ['product'=> $product->toArray(), 'quantity' => rand(1, 5)];
        

        $data = [
            'products' => $productData
        ];
        
        Event::fake();

        $response = $this
        ->postJson('/api/orders', $data);

        $order = Order::find($response['order']['id']);
        $product_ingredient->ingredient->recordNotification();
        
        $event = new OrderCreated($order);
        $listener = new CheckOrderIngredientsStockLevel();
        $listener->handle($event);

        $response->assertCreated();
        
        Event::assertNotDispatched(IngredientStockLevelReachesHalf::class);
        Event::assertListening(IngredientStockLevelReachesHalf::class, SendNotificationToMerchant::class);
    }
}
