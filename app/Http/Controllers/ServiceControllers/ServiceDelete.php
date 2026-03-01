<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ServiceDelete
{
    public function delete(Request $request, Service $service) : View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $deleted = $service->delete();

        return response()->json([
            'message' => "Suppression utilisation",
            'success' => $deleted
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
