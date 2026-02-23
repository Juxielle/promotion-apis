<?php

namespace App\Http\Controllers\ProductControllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ProductById extends Controller
{
    public function byId(Request $request, Product $product): View|Response|JsonResponse
    {
        return $this->sendById($request, $product);
    }
}
