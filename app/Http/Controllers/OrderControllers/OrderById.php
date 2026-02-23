<?php

namespace App\Http\Controllers\OrderControllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderById extends Controller
{
    public function byId(Request $request, Order $order): View|Response|JsonResponse
    {
        return $this->sendById($request, $order);
    }
}
