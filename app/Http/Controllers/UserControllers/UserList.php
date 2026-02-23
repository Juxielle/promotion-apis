<?php

namespace App\Http\Controllers\UserControllers;

use App\Classes\Constant;
use App\Classes\RoutePath;
use App\EntityClasses\EntityField;
use App\EntityConstraints\UserConstraint;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Gestion des utilisateurs
 * Endpoints pour gérer les utilisateurs.
 */
class UserList extends Controller
{
    /**
     * Liste des utilisateurs.
     *
     * @response 200 [
     *  {
     *    "name": "MBEMBA Jean",
     *    "email": "example@gmail.com",
     *    "password": "1234",
     *    "role": "admin",
     *    "password": "1234"
     *  }
     * ]
     */
    public function list(Request $request): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $query = User::orderBy(EntityField::CREATED_AT, Constant::DESC_ORDER)
            ->orderBy(EntityField::UPDATED_AT, Constant::DESC_ORDER);

        if ($request->has(Constant::LAST_UPDATE))
            $query = $query->whereDate(EntityField::UPDATED_AT, '>=', Carbon::parse($request->last_update));

        $constraint = new UserConstraint();
        $query = $constraint->queryAfterSeach($request, $query);

        return $this->sendList($request, $query, RoutePath::USER_LIST_ROUTE);
    }
}
