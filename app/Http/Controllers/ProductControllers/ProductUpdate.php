<?php

namespace App\Http\Controllers\ProductControllers;

use App\Classes\RoutePath;
use App\EntityConstraints\ProductConstraint;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ProductUpdate extends Controller
{
    public function update(Request $request, Product $product): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new ProductConstraint();
        $product = $constraint->jamModel($request, $product);
        $result = $product->save();

        return $this->send($request, $product, RoutePath::PRODUCT_LIST_ROUTE);
    }
}
