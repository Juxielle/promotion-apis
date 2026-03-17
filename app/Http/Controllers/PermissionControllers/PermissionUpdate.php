<?php

namespace App\Http\Controllers\PermissionControllers;

use App\Classes\RoutePath;
use App\EntityConstraints\PermissionConstraint;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PermissionUpdate extends Controller
{
    public function update(Request $request, Permission $permission): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new PermissionConstraint();
        $permission = $constraint->jamModel($request, $permission);
        $result = $permission->save();

        return $this->send($request, $permission, RoutePath::PERMISSION_LIST_ROUTE);
    }
}
