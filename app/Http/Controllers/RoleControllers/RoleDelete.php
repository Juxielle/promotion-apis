<?php

namespace App\Http\Controllers\RoleControllers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class RoleDelete
{
    public function delete(Request $request, Role $role) : View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $deleted = $role->delete();

        return response()->json([
            'message' => "Suppression utilisation",
            'success' => $deleted
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
