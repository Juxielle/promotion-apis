<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Authentification des utilisateurs
 * Endpoints pour permettre aux utilisateurs de s'authentifier.
 */
class AuthLogout extends Controller
{
    /**
     * Deconnexion des utilisateurs.
     *
     * @response 200 {
     *    "success": true,
     *    "data": {}
     * }
 */
    public function logout(Request $request): View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response|JsonResponse
    {
        try {
            auth()->logout();

            if($request->wantsJson())
            {
                return response()->json(['success' => true], Response::HTTP_OK);
            }

            return redirect("/login");
        } catch (Exception $e) {
            if($request->wantsJson())
                return $this->catch(new Exception($e));

            return back()->withErrors(['error' => 'Echec de deconnexion.']);
        }
    }
}
