<?php

namespace App\Http\Controllers\OrderControllers;

use App\Classes\Constant;
use App\EntityConstraints\OrderConstraint;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class OrderStore extends Controller
{
    public function store(Request $request): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new OrderConstraint();
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
        $model = Order::create($storingData);

        if (!($model instanceof Order))
            return $this->catch(new Exception(Constant::NOT_FOUND_ERROR));

        return $this->sendById($request, $model);
    }
}
