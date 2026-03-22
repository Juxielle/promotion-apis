<?php

namespace App\Http\Controllers\OrderControllers;

use App\Classes\Constant;
use App\EntityClasses\EntityField;
use App\EntityConstraints\OrderConstraint;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLine;
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

        if($request->has(Constant::COMMAND_LINES)){
            $commandLines = $request->input(Constant::COMMAND_LINES);
            //$keys = [];
            foreach ($commandLines as $commandLine) {
                if(array_key_exists(EntityField::ARTICLE_COUNT, $commandLine)) continue;
                if(array_key_exists(EntityField::PRICE, $commandLine)) continue;
                if(array_key_exists(EntityField::PRODUCT_ID, $commandLine)) continue;
                $keys = [
                    EntityField::ARTICLE_COUNT => $commandLine[EntityField::ARTICLE_COUNT],
                    EntityField::PRICE => $commandLine[EntityField::PRICE],
                    EntityField::ORDER_ID => $model->id,
                    EntityField::PRODUCT_ID => $commandLine[EntityField::PRODUCT_ID],
                ];
                OrderLine::create($keys);

                /*$productId = $commandLine[EntityField::PRODUCT_ID];
                $keys[$productId] = [
                    EntityField::ARTICLE_COUNT => $commandLine[EntityField::ARTICLE_COUNT],
                    EntityField::PRICE => $commandLine[EntityField::PRICE],
                ];*/
            }
            //$model->products->attach($keys);
        }

        return $this->sendById($request, $model);
    }
}
