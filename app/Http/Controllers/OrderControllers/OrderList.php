<?php

namespace App\Http\Controllers\OrderControllers;

use App\Classes\Constant;
use App\Classes\RoutePath;
use App\EntityClasses\EntityField;
use App\EntityConstraints\OrderConstraint;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderList extends Controller
{
    public function list(Request $request): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $query = Order::orderBy(EntityField::CREATED_AT, Constant::DESC_ORDER)
            ->orderBy(EntityField::UPDATED_AT, Constant::DESC_ORDER);

        if ($request->has(Constant::LAST_UPDATE))
            $query = $query->whereDate(EntityField::UPDATED_AT, '>=', Carbon::parse($request->last_update));

        $constraint = new OrderConstraint();
        $query = $constraint->queryAfterSeach($request, $query);

        return $this->sendList($request, $query, RoutePath::ORDER_LIST_ROUTE);
    }
}
