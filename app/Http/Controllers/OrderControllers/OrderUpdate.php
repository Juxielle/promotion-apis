<?php

namespace App\Http\Controllers\OrderControllers;

use App\Classes\RoutePath;
use App\EntityConstraints\OrderConstraint;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderUpdate extends Controller
{
    public function update(Request $request, Order $order): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new OrderConstraint();
        $order = $constraint->jamModel($request, $order);
        $result = $order->save();

        return $this->send($request, $order, RoutePath::ORDER_LIST_ROUTE);
    }
}
