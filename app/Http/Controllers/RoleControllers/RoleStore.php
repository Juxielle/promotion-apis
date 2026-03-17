<?php

namespace App\Http\Controllers\RoleControllers;

use App\Classes\Constant;
use App\EntityConstraints\RoleConstraint;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class RoleStore extends Controller
{
    public function store(Request $request): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new RoleConstraint();
        $constraint->prefix = "";
        $rulesMessages = $constraint->getRules($request);

        $validator = Validator::make(
            $request->all(),
            $rulesMessages->rules,
            $rulesMessages->messages
        );

        if ($validator->fails())
            return $this->sendValidatorError($request, $validator->errors()->all());

        $storingData = $constraint->getStoringData($request);
        $model = Role::create($storingData);

        if (!($model instanceof Role))
            return $this->catch(new Exception(Constant::NOT_FOUND_ERROR));

        return $this->sendById($request, $model);
    }
}
