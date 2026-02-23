<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Classes\RoutePath;
use App\EntityConstraints\CategoryConstraint;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CategoryUpdate extends Controller
{
    public function update(Request $request, Category $category): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new CategoryConstraint();
        $category = $constraint->jamModel($request, $category);
        $result = $category->save();

        return $this->send($request, $category, RoutePath::CATEGORY_LIST_ROUTE);
    }
}
