<?php

namespace App\Http\Controllers\Api\IndexProducts;

use App\Http\Controllers\Controller;
use App\Models\Product;

class IndexProducts extends Controller
{
    public function __invoke(): IndexProductsResponse
    {
        $products = Product::all();

        return new IndexProductsResponse($products);
    }
}
