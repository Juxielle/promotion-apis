<?php

namespace App\Http\Controllers\PromotionControllers;

use App\Models\Promotion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PromotionDelete
{
    public function delete(Request $request, Promotion $promotion) : View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $deleted = $promotion->delete();

        return response()->json([
            'message' => "Suppression utilisation",
            'success' => $deleted
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
