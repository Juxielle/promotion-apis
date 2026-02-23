<?php

namespace App\Http\Controllers\ProductControllers;

use App\Classes\Constant;
use App\EntityConstraints\ProductConstraint;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class ProductStore extends Controller
{
    public function store(Request $request): View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $constraint = new ProductConstraint();
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
        $model = Product::create($storingData);

        if (!($model instanceof Product))
            return $this->catch(new Exception(Constant::NOT_FOUND_ERROR));

        return $this->sendById($request, $model);
    }
}
