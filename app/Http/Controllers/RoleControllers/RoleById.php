<?php

namespace App\Http\Controllers\RoleControllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class RoleById extends Controller
{
    public function byId(Request $request, Role $role): View|Response|JsonResponse
    {
        return $this->sendById($request, $role);
    }
}
