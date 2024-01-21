<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserAuthService;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;

class UserAuthController extends Controller
{
    protected $userAuthService;

    public function __construct(UserAuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }

    public function register(RegisterUserRequest $request)
    {
        $user = $this->userAuthService->createUser($request->validated());
        return response()->json(null, 201);

    }
    public function login(LoginUserRequest $request)
    {
        $token = $this->userAuthService->loginUser($request->validated());

        if (!$token) {
            return response()->json(['message' => 'Invalid Credentials'], 401);
        }

        return response()->json(['access_token' => $token]);
    }

    public function logout()
    {
        $this->userAuthService->logoutUser(auth()->user());
        return response()->json(['message' => 'Successfully logged out']);
    }
}
