<?php

namespace App\Http\Controllers\AuthControllers;

use App\EntityClasses\EntityField;
use App\EntityConstraints\UserConstraint;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Authentification des utilisateurs
 * Endpoints pour permettre aux utilisateurs de s'authentifier.
 */
class AuthChangePassword extends Controller
{
    /**
     * Changer le mot de passe.
     *
     * @bodyParam password string required L'ancien mot de passe. Exemple: 1234
     * @bodyParam new_password string required Le nouveau mot de passe. Exemple: 123456789
     *
     * @response 200 {
     *   "success": true,
     *   "data": {}
     * }
     */
    public function changePassword(Request $request): View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response|JsonResponse
    {
        $password = $request->input(EntityField::PASSWORD);
        $user = auth()->user();

        if (Hash::check($password, $user->password)) {
            $model = User::where(EntityField::EMAIL, $user->email)->first();
            $model->password = $request->input(EntityField::NEW_PASSWORD);
            $model->save();

            return $this->sendConfirmResponse($request, $model, true);
        } else {
            return $this->sendConfirmResponse($request, null, false);
        }
    }
}
