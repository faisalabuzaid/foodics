<?php

namespace App\Http\Controllers\Api\IndexProducts;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class IndexProductsResponse implements Responsable
{
    public function __construct(protected Collection $products)
    {
    }

    public function toResponse($request): JsonResponse
    {
        return response()->json([
            'products' => $this->products,
        ]);
    }
}
