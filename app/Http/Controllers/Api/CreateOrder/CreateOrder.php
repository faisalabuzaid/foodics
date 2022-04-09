<?php

namespace App\Http\Controllers\Api\CreateOrder;

use App\Actions\CreateNewOrderAction;
use App\Http\Controllers\Controller;

class CreateOrder extends Controller
{
    public function __invoke(CreateOrderRequest $request)
    {
        $action = new CreateNewOrderAction();

        $order = $action->execute($request->validated());

        return new CreateOrderResponse($order);
    }
}
