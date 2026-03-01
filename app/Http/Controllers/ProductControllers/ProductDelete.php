<?php

namespace App\Http\Controllers\ProductControllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ProductDelete
{
    public function delete(Request $request, Product $product) : View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $deleted = $product->delete();

        return response()->json([
            'message' => "Suppression utilisation",
            'success' => $deleted
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
