<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class UserDelete extends Controller
{
    public function delete(Request $request, User $user) : View|RedirectResponse|Redirector|Response|JsonResponse
    {
        $deleted = $user->delete();

        return response()->json([
            'message' => $message,
            'success' => $deleted
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function deletePermanent($id)
    {
        $deleted = User::where('id', $id)->forceDelete();
        $message = $deleted ? 'Utilisateur supprimé définitivement avec succès' : 'L\'utilisateur n\'a pas été supprimé';
        return array('id' => $id, 'success' => $deleted, 'message' => $message);
    }
}
