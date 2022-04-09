<?php

namespace App\Actions;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\OrderProduct;

class CreateNewOrderAction
{
    private array $request_data;

    private Order $order;

    public function execute(array $request_data): Order
    {
        $this->configure($request_data);
        $this->createOrder();
        $this->createOrderProducts();
        $this->dispatchEvents();

        return $this->order;
    }

    private function configure($request_data)
    {
        $this->request_data = $request_data;
    }

    private function createOrder()
    {
        $this->order = Order::create();
    }

    private function createOrderProducts(): CreateNewOrderAction
    {
        foreach ($this->request_data['products'] as $product) {
            $this->createOrderProduct($product);
        }
        $this->order->save();

        return $this;
    }

    private function createOrderProduct($product)
    {
        $order_product = OrderProduct::create(
            [
                'order_id'=>$this->order->id,
                'product_id'=>$product['product']['id'],
                'quantity' => $product['quantity']
            ]
        );
        $order_product->increaseIngredientsOutcomingQuantity();
    }

    private function dispatchEvents()
    {
        event(new OrderCreated($this->order));
    }
}
