<?php

namespace App\Http\Controllers\PermissionControllers;

use App\Models\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class PermissionDelete
{
    public function delete(Request $request, Permission $permission) : View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $deleted = $permission->delete();

        return response()->json([
            'message' => "Suppression utilisation",
            'success' => $deleted
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
