<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CategoryById extends Controller
{
    public function byId(Request $request, Category $category): View|Response|JsonResponse
    {
        return $this->sendById($request, $category);
    }
}
