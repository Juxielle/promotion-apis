<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class UserById extends Controller
{
    public function byId(Request $request, User $user): View|Response|JsonResponse
    {
        return $this->sendById($request, $user);
    }
}
