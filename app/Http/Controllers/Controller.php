<?php

namespace App\Http\Controllers;

use App\Classes\Constant;
use App\Classes\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    private function getPage(Request $request, Builder $query): Page
    {
        $count = $query->get()->count();
        $models = $query->paginate(Constant::PAGES_COUNT)->items();

        if ($count > Constant::PAGES_COUNT)
            $count = $count % Constant::PAGES_COUNT == 0 ? $count / Constant::PAGES_COUNT : ($count / Constant::PAGES_COUNT) + 1;
        else if ($count > 0) $count = 1;

        return new Page(
            models: $query->get(),
            pageCount: (int)$count,
            selectedPage: $request->has("page") ? $request->page : 1
        );
    }

    protected function sendList(Request $request, Builder $query, string $route): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $page = $this->getPage($request, $query);

        if ($request->wantsJson())
            return response()->json($page->models, Response::HTTP_OK);

        return view($route, compact('page'));
    }

    protected function send(Request $request, Model $model, string $route): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        if ($request->wantsJson())
            return response()->json($model, Response::HTTP_OK);

        return redirect($route)->with(["successMessage" => "Sauvegarde des données effectué avec succès... Merci pour votre confiance !"]);
    }

    protected function sendById(Request $request, Model $model): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        if ($request->wantsJson())
            return response()->json($model, Response::HTTP_OK);

        return redirect($request->input("route"));
    }

    protected function sendValidatorError(Request $request, array $errors, array $models = []): RedirectResponse|Redirector|Response|JsonResponse
    {
        if ($request->wantsJson())
            return $this->catch(new Exception());

        return Redirect::back()->withErrors($errors)->with($models);
    }

    protected function sendConfirmResponse(Request $request, mixed $data, bool $success, $route = ""): View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response|JsonResponse
    {
        if ($request->wantsJson()) {
            if (!$success)
                return $this->catch(new Exception());
            else return response()->json([
                Constant::MESSAGE => "",
                Constant::DATA => $data,
                Constant::SUCCESS => true
            ], Response::HTTP_OK);
        }

        if ($success) return redirect($route)->with($data);
        else return Redirect::back()->withErrors([])->with($data);
    }

    protected function catch(Exception $e): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $e->getMessage(),
            'error_code' => $e->getCode(),
            'success' => false
        ], Response::HTTP_BAD_REQUEST);
    }
}
