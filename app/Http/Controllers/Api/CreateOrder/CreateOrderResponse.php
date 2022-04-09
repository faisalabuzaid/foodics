<?php

namespace App\Http\Controllers\Api\CreateOrder;

use App\Models\Order;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class CreateOrderResponse implements Responsable
{
    public function __construct(private Order $order)
    {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'message' => 'Order created.',
            'order' => $this->order,
        ], 201);
    }
}
