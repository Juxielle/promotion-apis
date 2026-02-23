<?php

namespace App\Http\Controllers\AuthControllers;

use App\EntityClasses\EntityField;
use App\Http\Controllers\Controller;
use App\Models\CodeConfirm;
use App\Services\EmailMessageService;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Authentification des utilisateurs
 * Endpoints pour permettre aux utilisateurs de s'authentifier.
 */
class AuthSendCode extends Controller
{
    /**
     * Envoi du code de confirmation.
     *
     * @urlParam email string required L'adresse e-mail d'envoie de code. Exemple: example@gmail.com
     *
     * @response 200 {
     *    "success": true,
     *    "data": {
     *      "code": "1234",
     *      "email": "example@gmail.com"
     *    }
     * }
    */
    public function sendCode(Request $request): View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response|JsonResponse
    {
        $date = date('YmdHis');
        $hash = md5($date);
        $code = strtoupper(substr($hash, 0, 4));
        $user = auth()->user();

        $codeConfirm = new CodeConfirm();
        $codeConfirm->code = $code;
        $codeConfirm->email = $request->input(EntityField::EMAIL);
        $codeConfirm->save();

        $emailMessage = EmailMessageService::sendConfirmResponse($code, $user->name, $code);
        $emailResult = EmailService::send($user->email, $emailMessage);

        return $this->sendConfirmResponse($request, $code, $emailResult->isSuccess);
    }
}
