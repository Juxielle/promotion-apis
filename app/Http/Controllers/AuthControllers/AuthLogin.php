<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * @group Authentification des utilisateurs
 * Endpoints pour permettre aux utilisateurs de s'authentifier.
 */
class AuthLogin extends Controller
{
    /**
     * Connexion des utilisateurs.
     *
     * @bodyParam email string required L'adresse e-mail de l'utilisateur. Exemple: example@gmail.com
     * @bodyParam password string required son mot de passe. Exemple: 1234
     *
     * @response 200 {
     *    "success": true,
     *    "token": "zhbjhfdkj-shhj245455",
     *    "data": {
     *      "name": "MBEMBA Jean",
     *      "email": "example@gmail.com",
     *      "role": "admin",
     *      "password": "1234"
     *    }
     *  }
     */
    public function login(Request $request): View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response|JsonResponse
    {
        $user = User::where('telephone', $request->input('email'))->first();
        if($user !== null){
            $request->email = $user->email;
        }
        $credentials = ['email' => $request->email, 'password' => $request->password];

        $validation = Validator::make(
            $credentials,
            [
                'email' => 'required|string',
                'password' => 'required|string|max:255'
            ],
            [
                'email.required' => "Le pseudo est obligatoire",
                'password.required' => "Le mot de passe est obligatoire",
            ]
        );

        if ($validation->fails()) {
            if($request->wantsJson())
                return $this->catch(new Exception('Pseudo ou mot de passe incorrect.'));

            $errors = $validation->errors();
            return back()->withErrors($errors);
        } else {
            try {
                if (!$token = !$request->wantsJson() ? Auth::attempt($credentials) : JWTAuth::attempt($credentials)) {
                    if($request->wantsJson())
                        return $this->catch(new Exception('Pseudo ou mot de passe incorrect.'));

                    return back()->withErrors(['user' => 'Pseudo ou mot de passe incorrect.']);
                }
            } catch (Exception $e) {
                if($request->wantsJson())
                    return $this->catch(new Exception($e));

                return back()->withErrors(['error' => 'Echec de connexion.']);
            }

            $user = Auth::user();
            if($request->wantsJson())
            {
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'user' => $user
                ], Response::HTTP_OK);
            }

            return redirect("/");
        }
    }
}
