<?php

namespace App\Http\Controllers\PermissionControllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PermissionById extends Controller
{
    public function byId(Request $request, Permission $permission): View|Response|JsonResponse
    {
        return $this->sendById($request, $permission);
    }
}
