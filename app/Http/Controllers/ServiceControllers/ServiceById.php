<?php

namespace App\Http\Controllers\ServiceControllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ServiceById extends Controller
{
    public function byId(Request $request, Service $service): View|Response|JsonResponse
    {
        return $this->sendById($request, $service);
    }
}
