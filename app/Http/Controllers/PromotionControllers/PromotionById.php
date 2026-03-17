<?php

namespace App\Http\Controllers\PromotionControllers;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PromotionById extends Controller
{
    public function byId(Request $request, Promotion $promotion): View|Response|JsonResponse
    {
        return $this->sendById($request, $promotion);
    }
}
