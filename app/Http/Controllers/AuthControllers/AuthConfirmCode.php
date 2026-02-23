<?php

namespace App\Http\Controllers\AuthControllers;

use App\EntityClasses\EntityField;
use App\Http\Controllers\Controller;
use App\Models\CodeConfirm;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Authentification des utilisateurs
 * Endpoints pour permettre aux utilisateurs de s'authentifier.
 */
class AuthConfirmCode extends Controller
{
    /**
     * Confirmation de code.
     *
     * @bodyParam code string required Le code confirmation. Exemple: 1234
     *
     * @response 200 {
     *   "success": true,
     *   "data": {}
     * }
 */
    public function confirmCode(Request $request): View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response|JsonResponse
    {
        if(!$request->has(EntityField::CODE))
            return $this->sendConfirmResponse($request, null, false);

        $code = $request->input(EntityField::CODE);
        $codeConfirm = CodeConfirm::where(EntityField::CODE, $code)->first();

        return $this->sendConfirmResponse($request, $code, $codeConfirm != null);
    }
}
