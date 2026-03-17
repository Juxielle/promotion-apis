<?php

namespace App\Http\Controllers\RoleControllers;

use App\Classes\RoutePath;
use App\EntityConstraints\RoleConstraint;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class RoleUpdate extends Controller
{
    public function update(Request $request, Role $role): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new RoleConstraint();
        $role = $constraint->jamModel($request, $role);
        $result = $role->save();

        return $this->send($request, $role, RoutePath::ROLE_LIST_ROUTE);
    }
}
