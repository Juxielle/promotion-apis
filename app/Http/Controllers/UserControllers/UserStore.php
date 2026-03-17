<?php

namespace App\Http\Controllers\UserControllers;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\EntityConstraints\UserConstraint;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Gestion des utilisateurs
 * Endpoints pour gérer les utilisateurs.
 */
class UserStore extends Controller
{
    /**
     * Créer un utilisateur.
     *
     * @bodyParam name string required Le nom complet de l’utilisateur. Exemple: MBEMBA Jean
     * @bodyParam email string required L’adresse email de l’utilisateur. Exemple: example@gmail.com
     * @bodyParam role string optional Le rôle attribué à l’utilisateur (ex: admin, user). Exemple: admin
     * @bodyParam password string optional Le mot de passe de l’utilisateur. Exemple: 1234
     *
     * @response 200 {
     *   "name": "MBEMBA Jean",
     *   "email": "example@gmail.com",
     *   "role": "admin",
     *   "password": "zdhfnç-hjgj6354-7289hgjhghj"
     * }
     */
    public function store(Request $request): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new UserConstraint();
        $constraint->prefix = "";
        $rulesMessages = $constraint->getRules($request);

        $validator = Validator::make(
            $request->all(),
            $rulesMessages->rules,
            $rulesMessages->messages
        );

        if ($validator->fails())
            return $this->sendValidatorError($request, $validator->errors()->all());

        $keys = [EntityField::ROLE_ID, $this->getRoleId($request->input(EntityField::ROLE))];
        $storingData = $constraint->getStoringData($request, $keys);
        $model = User::create($storingData);

        if(!($model instanceof User))
            return $this->catch(new Exception(Constant::NOT_FOUND_ERROR));

        return $this->sendById($request, $model);
    }

    private function getRoleId(string $role): int
    {
        if($role != Constant::SUPER_ADMIN_CODE && $role != Constant::ADMIN_CODE &&
           $role != Constant::CUSTOMER_CODE && $role != Constant::SELLER_CODE &&
           $role != Constant::PROVIDER_CODE){
            $role =  Constant::CUSTOMER_CODE;
        }
        $userRole = Role::where('code', $role)->first();
        return $userRole->id;
    }
}
