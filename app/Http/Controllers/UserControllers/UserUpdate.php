<?php

namespace App\Http\Controllers\UserControllers;

use App\Classes\RoutePath;
use App\EntityConstraints\UserConstraint;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Gestion des utilisateurs
 * Endpoints pour gérer les utilisateurs.
 */
class UserUpdate extends Controller
{
    /**
     * Modifier un utilisateur.
     *
     * @bodyParam name string required Le nom complet de l’utilisateur. Exemple: MBEMBA Jean
     * @bodyParam email string required L’adresse email de l’utilisateur. Exemple: example@gmail.com
     * @bodyParam role string optional Le rôle attribué à l’utilisateur (ex: admin, user). Exemple: admin
     *
     * @response 200 {
     *   "name": "MBEMBA Jean",
     *   "email": "example@gmail.com",
     *   "role": "admin",
     *   "password": "1234"
     * }
     */
    public function update(Request $request, User $user): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new UserConstraint();
        $user = $constraint->jamModel($request, $user);
        $result = $user->save();

        return $this->send($request, $user, RoutePath::USER_LIST_ROUTE);
    }
}
