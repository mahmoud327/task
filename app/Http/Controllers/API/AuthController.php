<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use ArinaSystems\JsonResponse\Facades\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        return JsonResponse::json('ok', ['data' => UserResource::make($user)]);
    }

    public function login(AuthRequest $request)
    {

        $credentials = request(['email', 'password']);
        if (!auth()->attempt($credentials)) {

            return sendJsonError('Email or Password not correct', 401);
        }

        return JsonResponse::json('ok', ['data' => UserResource::make(request()->user())]);

    }

}
