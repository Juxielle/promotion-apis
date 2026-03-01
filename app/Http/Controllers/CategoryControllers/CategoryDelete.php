<?php

namespace App\Http\Controllers\CategoryControllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class CategoryDelete
{
    public function delete(Request $request, Category $category) : View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $deleted = $category->delete();

        return response()->json([
            'message' => "Suppression utilisation",
            'success' => $deleted
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
