<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Classes\RoutePath;
use App\EntityConstraints\ServiceConstraint;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ServiceUpdate extends Controller
{
    public function update(Request $request, Service $service): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new ServiceConstraint();
        $service = $constraint->jamModel($request, $service);
        $result = $service->save();

        return $this->send($request, $service, RoutePath::SERVICE_LIST_ROUTE);
    }
}
