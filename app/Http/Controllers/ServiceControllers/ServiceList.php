<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Classes\Constant;
use App\Classes\RoutePath;
use App\EntityClasses\EntityField;
use App\EntityConstraints\ServiceConstraint;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ServiceList extends Controller
{
    public function list(Request $request): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $query = Service::orderBy(EntityField::CREATED_AT, Constant::DESC_ORDER)
            ->orderBy(EntityField::UPDATED_AT, Constant::DESC_ORDER);

        if ($request->has(Constant::LAST_UPDATE))
            $query = $query->whereDate(EntityField::UPDATED_AT, '>=', Carbon::parse($request->last_update));

        $constraint = new ServiceConstraint();
        $query = $constraint->queryAfterSeach($request, $query);

        return $this->sendList($request, $query, RoutePath::SERVICE_LIST_ROUTE);
    }
}
